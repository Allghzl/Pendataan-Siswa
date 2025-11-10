<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            [
                'nama_kelas' => 'X RPL 1',
                'wali_kelas' => 'Budi Santoso, S.Kom'
            ],
            [
                'nama_kelas' => 'X RPL 2',
                'wali_kelas' => 'Siti Aminah, S.Pd'
            ],
            [
                'nama_kelas' => 'XI RPL 1',
                'wali_kelas' => 'Andi Wijaya, S.Ag'
            ],
            [
                'nama_kelas' => 'XI RPL 2',
                'wali_kelas' => 'Dewi Lestari, S.Kom M.Kom'
            ],
            [
                'nama_kelas' => 'XII RPL 1',
                'wali_kelas' => 'Rina Susanti, S.Pd'
            ],
            [
                'nama_kelas' => 'XII RPL 2',
                'wali_kelas' => 'Agus Prasetyo, S.Kom'
            ],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
