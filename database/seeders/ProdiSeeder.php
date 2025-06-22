<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        prodi::create([
            'kode_prodi' => 57401,
            'nama_prodi' => 'D3 Manajemen Informatika',
            'nama_kaprodi' => 'Abdul Rozaq, S.Kom., M.M., M.Kom.',
        ]);

        prodi::create([
            'kode_prodi' => 63311,
            'nama_prodi' => 'D4 Bisnis Digital',
            'nama_kaprodi' => 'Rudy Haryanto, S.Sos., M.M.',
        ]);
    }
}
