<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Obat;
use Illuminate\Support\Facades\Hash;

class KlinikSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Apoteker
        User::create([
            'nama' => 'Apoteker Maxilla',
            'nik' => '3328000000000003',
            'email' => 'apoteker@maxilla.com',
            'password' => Hash::make('password'),
            'role' => 'apoteker',
            'no_wa' => '081234567893',
            'is_active' => true,
        ]);

        // 2. Akun Kasir
        User::create([
            'nama' => 'Kasir Maxilla',
            'nik' => '3328000000000004',
            'email' => 'kasir@maxilla.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
            'no_wa' => '081234567894',
            'is_active' => true,
        ]);

        // 3. Data Obat Awal
        $obats = [
            ['nama_obat' => 'Paracetamol 500mg', 'stok' => 100, 'harga' => 5000],
            ['nama_obat' => 'Amoxicillin 500mg', 'stok' => 50, 'harga' => 15000],
            ['nama_obat' => 'Asam Mefenamat 500mg', 'stok' => 75, 'harga' => 10000],
            ['nama_obat' => 'Ibuprofen 400mg', 'stok' => 80, 'harga' => 12000],
            ['nama_obat' => 'Dexamethasone 0.5mg', 'stok' => 40, 'harga' => 8000],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
