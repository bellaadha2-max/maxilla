<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\JadwalDokter;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings/queue.
     */
    public function index()
    {
        $adminCabang = auth()->user()->cabang ?? 'utama';

        // Get reservations for today in the user's branch
        $reservasis = Reservasi::with('user')
            ->where('cabang', $adminCabang)
            ->whereDate('tanggal', date('Y-m-d'))
            ->orderBy('jam', 'asc')
            ->get();

        $bookings = $reservasis->map(function($reservasi, $index) {
            $waktu = $reservasi->jam;
            if (preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $waktu)) {
                $waktu = \Carbon\Carbon::parse($waktu)->format('H:i');
            } else {
                $waktu = ucfirst($waktu); // Pagi, Siang, Sore etc
            }

            return [
                'id'         => $reservasi->id_reservasi,
                'no_antrian' => 'A-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'pasien'     => $reservasi->nama_pasien ?? ($reservasi->user->nama ?? 'No Name'),
                'hubungan'   => $reservasi->hubungan,
                'poli'       => 'Poli Umum',
                'dokter'     => $reservasi->dokter_nama ?? 'Belum Ditentukan',
                'status'     => strtolower($reservasi->status ?? 'menunggu'),
                'waktu'      => $waktu,
            ];
        });

        // Compute mini stats
        $stats = [
            'total'    => $bookings->count(),
            'menunggu' => $bookings->filter(fn($b) => in_array($b['status'], ['menunggu', 'hadir']))->count(),
            'selesai'  => $bookings->where('status', 'selesai')->count(),
            'diproses' => $bookings->filter(fn($b) => in_array($b['status'], ['diperiksa', 'menunggu antrian']))->count(),
        ];

        return view('admin.booking.index', compact('bookings', 'stats'));
    }

    /**
     * Panggil pasien ke poli — langsung set status "Diperiksa"
     * sehingga pasien muncul di antrian dokter yg bersangkutan.
     */

     public function create()
    {
        return view('admin.booking.create');
    }

    public function availableDoctors(Request $request)
    {
        $cabang = auth()->user()->cabang;
        $tanggal = $request->query('tanggal'); // YYYY-MM-DD
        $sesi = $request->query('jam'); // Pagi, Siang, Sore

        if (!$cabang || !$tanggal || !$sesi) {
            return response()->json([]);
        }

        // Parse tanggal untuk mendapatkan nama hari dalam Bahasa Indonesia
        $carbonDate = \Carbon\Carbon::parse($tanggal)->locale('id');
        $hari = $carbonDate->translatedFormat('l'); // 'Senin', 'Selasa', dll

        $dokters = JadwalDokter::where('cabang', $cabang)
            ->where('hari', $hari)
            ->where('sesi', $sesi)
            ->select('id', 'dokter_nama')
            ->get();

        return response()->json($dokters);
    }

public function searchPatientByNik(Request $request)
{
    $nik = $request->query('nik');
    if (!$nik) {
        return response()->json(null);
    }

    $user = User::where('nik', $nik)
        ->where('role', 'pasien')
        ->with('pasien')
        ->first();

    if ($user) {
        return response()->json([
            'nama' => $user->nama,
            'jenis_kelamin' => $user->pasien->jenis_kelamin ?? 'Laki-laki',
            'tanggal_lahir' => $user->pasien->tanggal_lahir ?? '',
            'alamat' => $user->pasien->alamat ?? '',
            'riwayat_penyakit' => $user->pasien->riwayat_penyakit ?? '',
            'alergi_obat' => $user->pasien->alergi_obat ?? '',
        ]);
    }

    return response()->json(null);
}

public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|string|size:16',
        'nama_pasien' => 'required|string|max:255',
        'jenis_kelamin_pasien' => 'required|in:Laki-laki,Perempuan',
        'tanggal_lahir_pasien' => 'required|date',
        'alamat' => 'required|string|max:500',
        'riwayat_penyakit' => 'nullable|string|max:1000',
        'alergi_obat' => 'nullable|string|max:1000',
        'tanggal' => 'required|date',
        'jam' => 'required|string',
        'dokter' => 'required|string',
        'hubungan' => 'nullable|string|max:100',
        'keluhan' => 'nullable|string|max:1000',
    ]);

    // 1. Cari atau buat User dengan role 'pasien' berdasarkan NIK
    $user = User::where('nik', $request->nik)->first();

    if (!$user) {
        // Generate automatic email based on NIK to satisfy database constraints
        $email = $request->nik . '@maxilla.com';
        
        // Buat User baru
        $user = User::create([
            'nama' => $request->nama_pasien,
            'nik' => $request->nik,
            'email' => $email,
            'password' => bcrypt($request->nik), // password default adalah NIK
            'role' => 'pasien',
            'is_active' => true,
        ]);
    } else {
        // Update nama user jika ada perubahan dari admin
        $user->update([
            'nama' => $request->nama_pasien,
        ]);
    }

    // 2. Buat atau update profil medis di tabel pasiens
    \App\Models\Pasien::updateOrCreate(
        ['id_user' => $user->id_user],
        [
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin_pasien,
            'tanggal_lahir' => $request->tanggal_lahir_pasien,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'alergi_obat' => $request->alergi_obat,
        ]
    );

    // Tentukan status awal berdasarkan tanggal reservasi (jika hari ini langsung 'Hadir')
    $isToday = \Carbon\Carbon::parse($request->tanggal)->isToday();
    $statusAwal = $isToday ? 'Hadir' : 'Menunggu';

    // 3. Simpan data Reservasi dengan id_user terhubung
    Reservasi::create([
        'id_user' => $user->id_user,
        'nama_pasien' => $request->nama_pasien,
        'jenis_kelamin_pasien' => $request->jenis_kelamin_pasien,
        'tanggal_lahir_pasien' => $request->tanggal_lahir_pasien,
        'hubungan' => 'Booking Manual',
        'keluhan' => $request->keluhan,
        'cabang' => auth()->user()->cabang,
        'tanggal' => $request->tanggal,
        'jam' => $request->jam,
        'dokter_nama' => $request->dokter,
        'status' => $statusAwal,
    ]);

    // Kirim Notifikasi ke semua staf terkait (Admin)
    $cabang = auth()->user()->cabang;
    $staff = User::whereIn('role', ['admin'])
        ->where('cabang', $cabang)
        ->get();

    if (!empty($request->dokter)) {
        $dokterClean = preg_replace('/^(drg\.|dr\.|drg|dr)\s+/i', '', $request->dokter);
        $dokterUser = User::where('role', 'dokter')
            ->where('nama', 'LIKE', '%' . $dokterClean . '%')
            ->first();
        if ($dokterUser) {
            $staff->push($dokterUser);
        }
    }

    $title = $statusAwal === 'Hadir' ? 'Pasien Hadir (Check-In)' : 'Reservasi Baru';
    $msg = $statusAwal === 'Hadir' 
        ? 'Pasien ' . $request->nama_pasien . ' telah check-in di cabang ' . $cabang . '.'
        : 'Ada reservasi baru atas nama ' . $request->nama_pasien . ' untuk sesi ' . $request->jam . ' di cabang ' . $cabang . '.';

    foreach ($staff as $userStaff) {
        $url = '#';
        if ($userStaff->role === 'admin') $url = '/admin/booking';
        elseif ($userStaff->role === 'dokter') $url = '/dokter/antrian';
        elseif ($userStaff->role === 'apoteker') $url = '/apoteker/antrian';
        elseif ($userStaff->role === 'kasir') $url = '/kasir/dashboard';

        $userStaff->notify(new \App\Notifications\SystemNotification($title, $msg, $url));
    }

    return redirect()
        ->route('admin.booking.index')
        ->with('success', 'Booking manual berhasil dibuat.');
}

public function checkinPasien($id)
{
    $reservasi = Reservasi::findOrFail($id);

    if ($reservasi->status !== 'Menunggu') {
        return back()->with('error', 'Status reservasi tidak valid untuk check-in.');
    }

    $reservasi->update(['status' => 'Hadir']);

    // Kirim Notifikasi ke semua staf terkait (Admin, Dokter, Apoteker, Kasir)
    $cabang = $reservasi->cabang;
    $staff = User::whereIn('role', ['admin', 'apoteker', 'kasir'])
        ->where('cabang', $cabang)
        ->get();

    if (!empty($reservasi->dokter_nama)) {
        $dokterClean = preg_replace('/^(drg\.|dr\.|drg|dr)\s+/i', '', $reservasi->dokter_nama);
        $dokterUser = User::where('role', 'dokter')
            ->where('nama', 'LIKE', '%' . $dokterClean . '%')
            ->first();
        if ($dokterUser) {
            $staff->push($dokterUser);
        }
    }

    foreach ($staff as $userStaff) {
        $url = '#';
        if ($userStaff->role === 'admin') $url = '/admin/booking';
        elseif ($userStaff->role === 'dokter') $url = '/dokter/antrian';
        elseif ($userStaff->role === 'apoteker') $url = '/apoteker/antrian';
        elseif ($userStaff->role === 'kasir') $url = '/kasir/dashboard';

        $userStaff->notify(new \App\Notifications\SystemNotification(
            'Pasien Hadir (Check-In)',
            'Pasien ' . ($reservasi->nama_pasien ?? ($reservasi->user->nama ?? 'Pasien')) . ' telah check-in di cabang ' . $cabang . '.',
            $url
        ));
    }

    return back()->with('success', 'Pasien ' . ($reservasi->nama_pasien ?? ($reservasi->user->nama ?? '')) . ' berhasil check-in!');
}

public function panggilPoli(Request $request, $id)
{
    $reservasi = Reservasi::with('user')->findOrFail($id);

    // Hanya bisa panggil kalau pasien sudah hadir (check-in)
    if (strtolower($reservasi->status) !== 'hadir') {
        return back()->with('error', 'Pasien belum melakukan check-in atau sudah dipanggil.');
    }

    // Langsung set Diperiksa — pasien masuk antrian dokter sekarang
    $reservasi->update(['status' => 'Diperiksa']);

    return back()->with('success', 'Pasien ' . ($reservasi->nama_pasien ?? ($reservasi->user->nama ?? '')) . ' berhasil dipanggil dan masuk antrian dokter!');
}
}
