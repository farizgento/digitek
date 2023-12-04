<?php

namespace Database\Seeders;

use App\Models\TipeBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipeBuku::insert([
            ['id' => 1, 'nama' => 'Fiksi', 'sekolah_id' => 1],
            ['id' => 2, 'nama' => 'Aksi', 'sekolah_id' => 1],
            ['id' => 3, 'nama' => 'Horror', 'sekolah_id' => 1],
        ]);
    }
}
