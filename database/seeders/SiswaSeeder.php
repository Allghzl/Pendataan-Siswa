<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        if (Kelas::count() === 0) {
            $this->call(KelasSeeder::class);
        }

        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            for ($i = 1; $i <= 10; $i++) {
                Siswa::create([
                    'nis' => $faker->unique()->numerify('########'),
                    'nama_lengkap' => $faker->firstName . ' ' . $faker->lastName, // tanpa gelar
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'alamat' => $faker->address,
                    'tanggal_lahir' => $faker->date('Y-m-d', '2010-12-31'),
                    'kelas_id' => $kelas->id,
                    'foto' => "https://picsum.photos/seed/{$faker->unique()->word}/200/200",
                ]);
            }
        }
    }
}
