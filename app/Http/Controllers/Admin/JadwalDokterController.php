<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalDokterController extends Controller
{
    /**
     * Show create schedule form.
     */
    public function create()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $activeCabang = auth()->user()->cabang;

        return view('admin.jadwal_dokter.create', compact('days', 'activeCabang'));
    }

    /**
     * Display a listing of doctor schedules.
     */
    public function index()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $activeCabang = auth()->user()->cabang;

        $schedules = JadwalDokter::query()
            ->where('cabang', $activeCabang)
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
                    'hari' => $jadwal->hari,
                    'dokter' => $jadwal->dokter_nama,
                    'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                    'sesi' => $jadwal->sesi,
                    'kuota' => $jadwal->kuota,
                ];
            })
            ->values()
            ->all();

        return view('admin.jadwal_dokter.index', compact('schedules', 'days', 'activeCabang'));
    }

    /**
     * Display the specified doctor schedule with patient list.
     */
    public function show($id)
    {
        $jadwal = JadwalDokter::query()
            ->where('id', $id)
            ->where('cabang', auth()->user()->cabang)
            ->firstOrFail();

        $schedule = [
            'id' => $jadwal->id,
            'dokter' => $jadwal->dokter_nama,
            'hari' => $jadwal->hari,
            'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
            'sesi' => $jadwal->sesi,
            'kuota' => $jadwal->kuota,
        ];

        // Load real patient list for this schedule (today's reservations)
        $reservasis = \App\Models\Reservasi::with('user')
            ->where('cabang', auth()->user()->cabang)
            ->where('dokter_nama', $jadwal->dokter_nama)
            // Just an assumption: we show today's patients. Or we show all for this day of week, but since it's realtime let's filter by today.
            ->whereDate('tanggal', date('Y-m-d'))
            ->orderBy('jam')
            ->get();

        $patients = $reservasis->map(function($res, $index) {
            $waktu = $res->jam;
            if (preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $waktu)) {
                $waktu = \Carbon\Carbon::parse($waktu)->format('H:i');
            } else {
                $waktu = ucfirst($waktu); // Pagi, Siang, Sore etc
            }

            return [
                'id_reservasi' => $res->id_reservasi,
                'no_antrian' => 'A' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama' => $res->user ? $res->user->nama : 'No Name',
                'waktu' => $waktu,
                'status' => strtolower($res->status ?? 'menunggu')
            ];
        })->toArray();

        return view('admin.jadwal_dokter.show', compact('schedule', 'patients'));
    }

    /**
     * Show edit schedule form.
     */
    public function edit($id)
    {
        $jadwal = JadwalDokter::query()
            ->where('id', $id)
            ->where('cabang', auth()->user()->cabang)
            ->firstOrFail();

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $activeCabang = auth()->user()->cabang;

        return view('admin.jadwal_dokter.edit', [
            'schedule' => $jadwal,
            'days' => $days,
            'activeCabang' => $activeCabang,
        ]);
    }

    /**
     * Store a newly created doctor schedule.
     */
    public function store(Request $request)
    {
        $validated = $this->validateSchedule($request);

        $conflictExists = JadwalDokter::query()
            ->whereRaw('LOWER(dokter_nama) = ?', [strtolower($validated['dokter_nama'])])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query
                    ->where('jam_mulai', '<', $validated['jam_selesai'])
                    ->where('jam_selesai', '>', $validated['jam_mulai']);
            })
            ->exists();

        if ($conflictExists) {
            return back()
                ->withErrors([
                    'jam_mulai' => 'Jadwal bentrok: dokter ini sudah memiliki praktik di cabang lain pada rentang waktu tersebut.',
                ])
                ->withInput();
        }

        JadwalDokter::create([
            'cabang' => auth()->user()->cabang,
            'dokter_nama' => $validated['dokter_nama'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'sesi' => $this->resolveSesi($validated['jam_mulai']),
            'kuota' => $validated['kuota'],
        ]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }

    /**
     * Update existing doctor schedule.
     */
    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::query()
            ->where('id', $id)
            ->where('cabang', auth()->user()->cabang)
            ->firstOrFail();

        $validated = $this->validateSchedule($request);

        $conflictExists = JadwalDokter::query()
            ->where('id', '!=', $jadwal->id)
            ->whereRaw('LOWER(dokter_nama) = ?', [strtolower($validated['dokter_nama'])])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query
                    ->where('jam_mulai', '<', $validated['jam_selesai'])
                    ->where('jam_selesai', '>', $validated['jam_mulai']);
            })
            ->exists();

        if ($conflictExists) {
            return back()
                ->withErrors([
                    'jam_mulai' => 'Jadwal bentrok: dokter ini sudah memiliki praktik di cabang lain pada rentang waktu tersebut.',
                ])
                ->withInput();
        }

        $jadwal->update([
            'dokter_nama' => $validated['dokter_nama'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'sesi' => $this->resolveSesi($validated['jam_mulai']),
            'kuota' => $validated['kuota'],
        ]);

        return redirect()
            ->route('admin.jadwal.show', ['id' => $jadwal->id])
            ->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    private function validateSchedule(Request $request): array
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return $request->validate([
            'dokter_nama' => ['required', 'string', 'max:120'],
            'hari' => ['required', Rule::in($days)],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'kuota' => ['required', 'integer', 'min:1', 'max:100'],
        ], [
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
        ]);
    }

    private function resolveSesi(string $jamMulai): string
    {
        if ($jamMulai < '12:00') {
            return 'Pagi';
        }

        if ($jamMulai < '16:00') {
            return 'Siang';
        }

        return 'Sore';
    }
}
