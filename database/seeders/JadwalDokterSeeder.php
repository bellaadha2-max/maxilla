<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalDokter;

class JadwalDokterSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan data lama agar tidak tumpuk
        JadwalDokter::truncate();

        $data = [
            // Senin
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Amanda Putri', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Budi Santoso', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Siti Aminah', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Amanda Putri', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Budi Santoso', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Andi Wijaya', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 4],
            
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Siti Aminah', 'hari' => 'Senin', 'jam_mulai' => '18:00:00', 'jam_selesai' => '21:00:00', 'sesi' => 'Sore', 'kuota' => 4],

            // Selasa
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Andi Wijaya', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 4],
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Fania', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 6],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Sekar Lela', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],

            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Andi Wijaya', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 4],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Fania', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Sekar Lela', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],

            // Rabu
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Amanda Putri', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Budi Santoso', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Siti Aminah', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 4],

            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Amanda Putri', 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Budi Santoso', 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            
            // Kamis
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Andi Wijaya', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 4],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Fania', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Sekar Lela', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],

            // Jumat
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Siti Aminah', 'hari' => 'Jumat', 'jam_mulai' => '08:00:00', 'jam_selesai' => '11:00:00', 'sesi' => 'Pagi', 'kuota' => 4],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Sekar Lela', 'hari' => 'Jumat', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Amanda Putri', 'hari' => 'Jumat', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],

            // Sabtu
            ['cabang' => 'Tegal', 'dokter_nama' => 'drg. Budi Santoso', 'hari' => 'Sabtu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 6],
            ['cabang' => 'Slawi', 'dokter_nama' => 'drg. Andi Wijaya', 'hari' => 'Sabtu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'sesi' => 'Pagi', 'kuota' => 5],
            ['cabang' => 'Brebes', 'dokter_nama' => 'drg. Fania', 'hari' => 'Sabtu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'sesi' => 'Siang', 'kuota' => 5],
        ];

        foreach ($data as $item) {
            JadwalDokter::create($item);
        }
    }
}
