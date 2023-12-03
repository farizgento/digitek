<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data1 = Buku::create([
            'judul' => 'Melangkah',
            'penulis' => 'J. S Khairen',
            'penerbitan' => 'Gramedia Widiasarana Indonesia',
            'bulan' => '2020-03-22', // Format tanggal disesuaikan dengan 'YYYY-MM-DD'
            'isbn' => '9786020523316',
            'sampul_buku' => 'sampul/buku1.jpg',
        ]);

        $data2 = Buku::create([
            'judul' => 'Laut Bercerita',
            'penulis' => 'Leila S. Chudori',
            'penerbitan' => 'Kepustakaan Populer Gramedia',
            'bulan' => '2017-09-25', // Format tanggal disesuaikan dengan 'YYYY-MM-DD'
            'isbn' => 'SCOOPG143505',
            'sampul_buku' => 'sampul/buku2.jpg',
        ]);

        $data3 = Buku::create([
            'judul' => 'Spy X Family 10',
            'penulis' => 'ENDO TATSUYA',
            'penerbitan' => 'Elex Media Komputindo',
            'bulan' => '2023-09-17', // Format tanggal disesuaikan dengan 'YYYY-MM-DD'
            'isbn' => '9786230050244',
            'sampul_buku' => 'sampul/buku3.jpg',
        ]);
    }
}
