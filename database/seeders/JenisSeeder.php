<?php

namespace Database\Seeders;

use App\Models\JenisBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisBuku::create([
            'id' => '1',
            'nama'  => 'Novel',
        ]);
        JenisBuku::create([
            'id' => '1',
            'nama'  => 'Ebook',
        ]);
        JenisBuku::create([
            'id' => '1',
            'nama'  => 'Penelitian',
        ]);

    }
}
