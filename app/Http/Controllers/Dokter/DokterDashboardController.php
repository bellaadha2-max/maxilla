<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    /**
     * Display the doctor's dashboard.
     */
    public function index()
    {
        $stats = $this->getStats();
        return view('dokter.dashboard', compact('stats'));
    }

    /**
     * Get real-time stats for API.
     */
    public function getRealtimeStats()
    {
        return response()->json([
            'stats' => $this->getStats(),
            'timestamp' => now()->translatedFormat('H:i:s')
        ]);
    }

    /**
     * Internal helper to calculate stats.
     */
    private function getStats()
    {
        $namaDokter = \Illuminate\Support\Facades\Auth::user()->nama;
        $namaTanpaGelar = trim(preg_replace('/^(drg\.|dr\.)\s*/i', '', $namaDokter));

        $total = \App\Models\Reservasi::where('dokter_nama', 'like', "%{$namaTanpaGelar}%")
            ->whereDate('tanggal', today())
            ->count();

        $selesai = \App\Models\Reservasi::where('dokter_nama', 'like', "%{$namaTanpaGelar}%")
            ->whereDate('tanggal', today())
            ->whereIn('status', ['Selesai', 'Menunggu Pembayaran', 'Menunggu Obat'])
            ->count();

        $menunggu = \App\Models\Reservasi::where('dokter_nama', 'like', "%{$namaTanpaGelar}%")
            ->whereDate('tanggal', today())
            ->where('status', 'Menunggu Antrian')
            ->count();

        return [
            'total' => $total,
            'selesai' => $selesai,
            'menunggu' => $menunggu
        ];
    }
    public function jadwal()
    {
        $namaDokter = \Illuminate\Support\Facades\Auth::user()->nama;
        $namaTanpaGelar = trim(preg_replace('/^(drg\.|dr\.)\s*/i', '', $namaDokter));

        $jadwals = \App\Models\JadwalDokter::where('dokter_nama', 'like', "%{$namaTanpaGelar}%")->get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function antrian()
    {
        $namaDokter = \Illuminate\Support\Facades\Auth::user()->nama;
        $namaTanpaGelar = trim(preg_replace('/^(drg\.|dr\.)\s*/i', '', $namaDokter));

        $antrians = \App\Models\Reservasi::with('user.pasien')
            ->where('dokter_nama', 'like', "%{$namaTanpaGelar}%")
            ->whereDate('tanggal', today())
            ->whereIn('status', ['Menunggu Antrian', 'Diperiksa', 'Menunggu Obat'])
            ->orderBy('jam', 'asc')
            ->get();
            
        return view('dokter.antrian.index', compact('antrians'));
    }

    public function riwayat()
    {
        $namaDokter = \Illuminate\Support\Facades\Auth::user()->nama;
        $namaTanpaGelar = trim(preg_replace('/^(drg\.|dr\.)\s*/i', '', $namaDokter));

        $riwayats = \App\Models\Reservasi::with('rekamMedis', 'user.pasien')
            ->where('dokter_nama', 'like', "%{$namaTanpaGelar}%")
            ->whereIn('status', ['Selesai', 'Menunggu Pembayaran'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return view('dokter.riwayat.index', compact('riwayats'));
    }
}
