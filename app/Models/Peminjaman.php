<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = [

        'denda',
        'kondisi_buku',
        'konfirmasi_pinjam',
        'konfirmasi_kembali',
        'buku_id',
        'sekolah_id',
        'user_id',
        'buku_id',
    ];
    
    public function buku(){
        return $this->belongsToMany(Buku::class);
    }
}
