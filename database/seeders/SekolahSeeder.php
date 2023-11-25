<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sekolah::create([
            'id' => 1,
            'nama' => 'SMAN 1 BATURETNO',
        ]);
        Sekolah::create([
            'id' => 2,
            'nama' => 'SMK NEGERI 2 KEDIRI',
        ]);

        Sekolah::create([
            'id' => 3,
            'nama' => 'SMPN 3 MALANG',
        ]);
    }
}
