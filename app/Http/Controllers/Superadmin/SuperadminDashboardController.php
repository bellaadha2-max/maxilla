<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\JadwalDokter;
use Carbon\Carbon;

class SuperadminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');

        // Fetch all reservations for today
        $reservationsToday = Reservasi::whereDate('tanggal', $today)->get();
        
        // Fetch all doctors scheduled for today
        // First we just get all schedules for $hariIni
        $schedulesToday = JadwalDokter::where('hari', $hariIni)->orderBy('jam_mulai')->get();

        // 1. Cabang Summaries
        $cabangs = ['slawi', 'tegal', 'brebes'];
        $cabangStats = [];

        foreach ($cabangs as $cabang) {
            $cabangStats[$cabang] = [
                'total_pasien' => $reservationsToday->where('cabang', $cabang)->count(),
                'dokter_aktif' => $schedulesToday->where('cabang', $cabang)->groupBy('dokter_nama')->count(),
                'selesai' => $reservationsToday->where('cabang', $cabang)->where('status', 'Selesai')->count(),
                'menunggu' => $reservationsToday->where('cabang', $cabang)->whereIn('status', ['Menunggu', 'Diproses'])->count(),
                'status' => 'buka' // default, but could calculate based on queues
            ];
            
            // Logic to label "penuh" if waiting > 10
            if ($cabangStats[$cabang]['menunggu'] > 10) {
                $cabangStats[$cabang]['status'] = 'penuh';
            }
        }

        // 2. Monthly Stats
        $monthlyReservations = Reservasi::whereMonth('tanggal', Carbon::now()->month)
                                        ->whereYear('tanggal', Carbon::now()->year)
                                        ->get();
        // Since we don't have separate Umum/BPJS flags, maybe we can mock this logic or use poli
        // Wait, 'poli' isn't explicitly umum/bpjs. In Pasien form they don't fill this field yet? 
        // For now, let's just make 'Umum' the total minus 'No Show' and randomly guess BPJS if needed, or just map it all.
        // If we have 'layanan', we can group by it.
        // Let's check Reservasi columns. We'll use random 70% 30% split if data doesn't exist, but it's realtime.
        // Or better yet, we just provide the true Total and 'batal'.
        $totalKunjunganBulanIni = $monthlyReservations->count();
        $totalBatal = $monthlyReservations->filter(function($r) { return strtolower($r->status) == 'dibatalkan'; })->count();
        
        $monthStats = [
            'total_kunjungan' => $totalKunjunganBulanIni,
            'total_no_show' => $totalBatal,
            'no_show_rate' => $totalKunjunganBulanIni > 0 ? round(($totalBatal / $totalKunjunganBulanIni) * 100, 1) : 0,
        ];
        
        // Find busiest branch
        $busiestCabang = $monthlyReservations->groupBy('cabang')->map->count()->sortDesc()->keys()->first() ?? 'Slawi';
        $monthStats['cabang_tersibuk'] = 'Maxilla ' . ucfirst($busiestCabang);

        // 3. Active Doctors Today List
        // Calculate load (pasien dilayani) for each doctor schedule
        foreach ($schedulesToday as $jadwal) {
            $jadwal->pasien_dilayani = $reservationsToday->where('cabang', $jadwal->cabang)
                                                         ->where('dokter_nama', $jadwal->dokter_nama)
                                                         ->count();
        }

        return view('superadmin.dashboard', compact('cabangStats', 'monthStats', 'schedulesToday'));
    }

    public function apiStats()
    {
        $today = Carbon::today();
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');

        // Fetch all reservations for today
        $reservationsToday = Reservasi::whereDate('tanggal', $today)->get();
        
        // Fetch all doctors scheduled for today
        $schedulesToday = JadwalDokter::where('hari', $hariIni)->orderBy('jam_mulai')->get();

        // 1. Cabang Summaries
        $cabangs = ['slawi', 'tegal', 'brebes'];
        $cabangStats = [];

        foreach ($cabangs as $cabang) {
            $cabangStats[$cabang] = [
                'total_pasien' => $reservationsToday->where('cabang', $cabang)->count(),
                'dokter_aktif' => $schedulesToday->where('cabang', $cabang)->groupBy('dokter_nama')->count(),
                'selesai' => $reservationsToday->where('cabang', $cabang)->where('status', 'selesai')->count(),
                'menunggu' => $reservationsToday->where('cabang', $cabang)->whereIn('status', ['menunggu', 'diproses'])->count(),
                'status' => 'buka'
            ];
            
            if ($cabangStats[$cabang]['menunggu'] > 10) {
                $cabangStats[$cabang]['status'] = 'penuh';
            }
        }

        // 2. Monthly Stats
        $monthlyReservations = Reservasi::whereMonth('tanggal', Carbon::now()->month)
                                        ->whereYear('tanggal', Carbon::now()->year)
                                        ->get();
        
        $totalKunjunganBulanIni = $monthlyReservations->count();
        $totalBatal = $monthlyReservations->filter(function($r) { return strtolower($r->status) == 'batal'; })->count();
        
        $monthStats = [
            'total_kunjungan' => $totalKunjunganBulanIni,
            'total_no_show' => $totalBatal,
            'no_show_rate' => $totalKunjunganBulanIni > 0 ? round(($totalBatal / $totalKunjunganBulanIni) * 100, 1) : 0,
        ];
        
        $busiestCabang = $monthlyReservations->groupBy('cabang')->map->count()->sortDesc()->keys()->first() ?? 'Slawi';
        $monthStats['cabang_tersibuk'] = 'Maxilla ' . ucfirst($busiestCabang);

        // 3. Active Doctors Load
        $doctorList = [];
        foreach ($schedulesToday as $jadwal) {
            $pasienDilayani = $reservationsToday->where('cabang', $jadwal->cabang)
                                                 ->where('dokter_nama', $jadwal->dokter_nama)
                                                 ->count();
            $percentage = $jadwal->kuota > 0 ? min(100, ($pasienDilayani / $jadwal->kuota) * 100) : 0;
            
            $doctorList[] = [
                'id' => $jadwal->id,
                'dokter_nama' => $jadwal->dokter_nama,
                'cabang' => $jadwal->cabang,
                'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                'pasien_dilayani' => $pasienDilayani,
                'kuota' => $jadwal->kuota,
                'percentage' => $percentage
            ];
        }

        return response()->json([
            'cabangStats' => $cabangStats,
            'monthStats' => $monthStats,
            'doctorList' => $doctorList,
            'timestamp' => Carbon::now()->translatedFormat('d F Y, H:i:s')
        ]);
    }
}
