<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'penulis',
        'penerbitan',
        'edisi',
        'bulan',
        'isbn',
        'subyek',
        'path',
        'volume',
        'sampul_buku',
        'lokasi_buku_id',
        'tipe_buku_id',
        'jenis_buku_id',
        'sekolah_id',
        'stok',
    ];
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class,'sekolah_id');
    }
    public function tipebuku()
    {
        return $this->belongsToMany(TipeBuku::class, 'buku_tipe_bukus', 'buku_id', 'tipe_buku_id');
    }
    public function jenisbuku()
    {
        return $this->belongsTo(JenisBuku::class,'jenis_buku_id');
    }
    public function lokasibuku()
    {
        return $this->belongsTo(LokasiBuku::class,'lokasi_buku_id');
    }

    public function peminjamen()
    {
        return $this->belongsToMany(Peminjaman::class, 'pivot_peminjamans', 'buku_id', 'peminjaman_id')->withTimestamps();
    }
}
