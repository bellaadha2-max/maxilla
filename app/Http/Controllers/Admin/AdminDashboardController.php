<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservasi;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $adminCabang = auth()->user()->cabang ?? 'utama';
        $hariIni = \Carbon\Carbon::now()->locale('id')->translatedFormat('l'); // Senin, Selasa, dll

        $reservasiHariIni = Reservasi::with('user')->where('cabang', $adminCabang)
            ->whereDate('tanggal', date('Y-m-d'))
            ->get();

        $stats = [
            'pasien_hari_ini' => $reservasiHariIni->count(),
            'antrean_aktif' => $reservasiHariIni->whereIn('status', ['menunggu', 'diproses', 'hadir', 'Menunggu', 'Diproses', 'Hadir'])->count(),
            'jadwal_dokter' => \App\Models\JadwalDokter::where('cabang', $adminCabang)->where('hari', $hariIni)->count(),
            'kapasitas_tersedia' => 'N/A' // placeholder
        ];

        $activeQueues = $reservasiHariIni->filter(function($res) {
            return in_array(strtolower($res->status), ['menunggu', 'hadir', 'diproses']);
        })->sortBy('jam')->values();

        $jadwalHariIni = \App\Models\JadwalDokter::where('cabang', $adminCabang)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.dashboard', compact('stats', 'activeQueues', 'jadwalHariIni'));
    }
}
