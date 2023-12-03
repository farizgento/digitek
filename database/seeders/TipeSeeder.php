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
        TipeBuku::create([
            'id' => 1,
            'nama' => 'Aksi',
        ]);
        TipeBuku::create([
            'id' => 1,
            'nama' => 'fiksi',
        ]);
    }
}
