<?php

namespace Database\Seeders;

use App\Models\JenisBuku;
use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisBuku::insert([
            ['id' => 1, 'nama' => 'Novel', 'sekolah_id' => 1],
            ['id' => 2, 'nama' => 'Ebook', 'sekolah_id' => 1],
            ['id' => 3, 'nama' => 'Penelitian', 'sekolah_id' => 1],
        ]);
        

    }
}
