<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'judul',
        'penulis',
        'penerbitan',
        'edisi',
        'bulan',
        'isbn',
        'subyek',
        'jenis',
        'path',
        'volume',
        'sampul_buku',
        'lokasi_buku_id',
        'tipe_buku_id',
        'jenis_buku_id',
        'sekolah_id',
    ];
}
