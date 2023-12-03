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
        LokasiBuku::create([
            'id' => 1,
            'lokasi' => 'Website',
        ]);
    }
}
