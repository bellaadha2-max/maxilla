<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservasi;
use App\Models\RekamMedis;
use App\Models\Obat;
use App\Models\ResepObat;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function create($id_reservasi)
    {
        $reservasi = Reservasi::with('user.pasien')->findOrFail($id_reservasi);
        // Menggunakan cabang dari reservasi pasien untuk memfilter stok obat
        $cabang_reservasi = $reservasi->cabang;
        $obats = Obat::where('cabang', $cabang_reservasi)->where('stok', '>', 0)->get();

        // Check if status is valid — hanya 'Diperiksa' yang boleh buka form
        if ($reservasi->status !== 'Diperiksa') {
            return redirect()->back()->with('error', 'Pasien belum dipanggil ke poli atau sudah selesai diperiksa.');
        }

        // Ambil riwayat rekam medis sebelumnya dari pasien yang sama (lintas cabang)
        $riwayatSebelumnya = collect();
        if ($reservasi->id_user) {
            $query = Reservasi::with(['rekamMedis.resepObats.obat'])
                ->where('id_user', $reservasi->id_user)
                ->where('id_reservasi', '!=', $id_reservasi)
                ->whereHas('rekamMedis');

            if ($reservasi->nama_pasien) {
                $query->where('nama_pasien', $reservasi->nama_pasien)
                    ->where('jenis_kelamin_pasien', $reservasi->jenis_kelamin_pasien)
                    ->where('tanggal_lahir_pasien', $reservasi->tanggal_lahir_pasien);
            } else {
                $query->whereNull('nama_pasien');
            }

            $riwayatSebelumnya = $query
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam', 'desc')
                ->get();
        }

        return view('dokter.rekam_medis.create', compact('reservasi', 'obats', 'riwayatSebelumnya'));
    }

    public function store(Request $request, $id_reservasi)
    {
        $request->validate([
            'subjective' => 'required|string',
            'objective' => 'required|string',
            'assesment' => 'required|string',
            'planning' => 'required|string',
            'biaya_tindakan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'odontogram' => 'nullable|string',
            'id_obat' => 'nullable|array',
            'id_obat.*' => 'exists:obats,id_obat',
            'jumlah_obat' => 'nullable|array',
            'aturan_pakai' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $reservasi = Reservasi::findOrFail($id_reservasi);

            $odontogramData = null;
            if ($request->odontogram) {
                $odontogramData = json_decode($request->odontogram, true);
            }

            $rekamMedis = RekamMedis::create([
                'id_reservasi' => $id_reservasi,
                'subjective' => $request->subjective,
                'objective' => $request->objective,
                'assesment' => $request->assesment,
                'planning' => $request->planning,
                'biaya_tindakan' => $request->biaya_tindakan,
                'keterangan' => $request->keterangan,
                'odontogram' => $odontogramData,
            ]);

            if ($request->has('id_obat')) {
                foreach ($request->id_obat as $key => $id_obat) {
                    if ($id_obat && $request->jumlah_obat[$key] > 0) {
                        ResepObat::create([
                            'id_rekam_medis' => $rekamMedis->id_rekam_medis,
                            'id_obat' => $id_obat,
                            'jumlah' => $request->jumlah_obat[$key],
                            'aturan_pakai' => $request->aturan_pakai[$key] ?? null,
                        ]);
                        
                        // Potong stok secara realtime saat resep dibuat
                        $obat = Obat::find($id_obat);
                        if ($obat) {
                            $obat->decrement('stok', $request->jumlah_obat[$key]);
                        }
                    }
                }
            }

            // Ubah status ke Menunggu Obat
            $reservasi->update(['status' => 'Menunggu Obat']);

            // Kirim Notifikasi ke Pasien terkait
            if ($reservasi->user) {
                $reservasi->user->notify(new \App\Notifications\SystemNotification(
                    'Pemeriksaan Selesai',
                    'Pemeriksaan Anda oleh ' . $reservasi->dokter_nama . ' telah selesai. Silakan menunggu resep obat Anda disiapkan di Apotek.',
                    url('/pasien/dashboard')
                ));
            }

            // Kirim Notifikasi ke semua staf terkait (Admin, Apoteker)
            $cabang = $reservasi->cabang;
            $staff = \App\Models\User::whereIn('role', ['admin', 'apoteker'])
                ->where('cabang', $cabang)
                ->get();

            foreach ($staff as $userStaff) {
                $url = '#';
                $title = 'Pasien Menunggu Obat';
                $msg = 'Pasien ' . ($reservasi->nama_pasien ?? ($reservasi->user->nama ?? 'Tidak diketahui')) . ' telah selesai diperiksa dan sekarang menunggu obat di cabang ' . $cabang . '.';

                if ($userStaff->role === 'admin') {
                    $url = '/admin/booking';
                    $title = 'Pemeriksaan Selesai';
                } elseif ($userStaff->role === 'apoteker') {
                    $url = '/apoteker/dashboard';
                } elseif ($userStaff->role === 'kasir') {
                    $url = '/kasir/dashboard';
                }

                $userStaff->notify(new \App\Notifications\SystemNotification($title, $msg, $url));
            }

            DB::commit();
            return redirect()->route('dokter.antrian')->with('success', 'Rekam medis dan resep obat berhasil disimpan. Pasien diarahkan ke Apotek.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id_reservasi)
    {
        $reservasi = Reservasi::with(['user.pasien', 'rekamMedis.resepObats.obat'])->findOrFail($id_reservasi);

        if (!$reservasi->rekamMedis) {
            return redirect()->back()->with('error', 'Rekam medis belum dibuat.');
        }

        return view('dokter.rekam_medis.show', compact('reservasi'));
    }
}
