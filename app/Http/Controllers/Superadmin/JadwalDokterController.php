<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    /**
     * Display a listing of doctor schedules from all branches.
     */
    public function index(Request $request)
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $cabang = $request->get('cabang', 'all');

        $query = JadwalDokter::query();

        if ($cabang !== 'all') {
            $query->where('cabang', $cabang);
        }

        $schedules = $query
            ->orderByRaw("CASE hari
                WHEN 'Senin' THEN 1
                WHEN 'Selasa' THEN 2
                WHEN 'Rabu' THEN 3
                WHEN 'Kamis' THEN 4
                WHEN 'Jumat' THEN 5
                WHEN 'Sabtu' THEN 6
                WHEN 'Minggu' THEN 7
                ELSE 8
            END")
            ->orderBy('jam_mulai')
            ->get()
            ->map(function (JadwalDokter $jadwal) {
                return [
                    'id' => $jadwal->id,
                    'cabang' => $jadwal->cabang,
                    'hari' => $jadwal->hari,
                    'dokter' => $jadwal->dokter_nama,
                    'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                    'sesi' => $jadwal->sesi,
                    'kuota' => $jadwal->kuota,
                ];
            })
            ->values()
            ->all();

        return view('superadmin.jadwal.index', compact('schedules', 'days', 'cabang'));
    }
}
