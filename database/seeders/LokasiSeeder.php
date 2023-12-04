<?php

namespace Database\Seeders;

use App\Models\LokasiBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokasiBuku::insert([
            ['id' => 1, 'lokasi' => 'Website', 'sekolah_id' => 1],
            ['id' => 2, 'lokasi' => 'Rak 1', 'sekolah_id' => 1],
        ]);
    }
}
