<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Definisikan enum untuk konfirmasi_peminjaman
    public const KONFIRMASI_PINJAMAN_VALUES = ['tertunda','diterima'];
    
    // Definisikan enum untuk konfirmasi_kembali
    public const KONFIRMASI_KEMBALI_VALUES = ['tertunda','diterima'];
    
    protected $table = 'peminjamans';
    protected $fillable = [

        'denda',
        'kondisi_buku',
        'tanggal_pengembalian',
        'konfirmasi_pinjam',
        'konfirmasi_kembali',
        'buku_id',
        'sekolah_id',
        'user_id',
    ];
    
    // Relasi many-to-many dengan model Buku melalui tabel perantara
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'pivot_peminjamans', 'peminjaman_id', 'buku_id')->withTimestamps();
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function sekolahs(){
        return $this->belongsTo(Sekolah::class,'sekolah_id');
    }
    
    // Metode akses untuk mendapatkan nilai enum konfirmasi_peminjaman
    public static function getKonfirmasiPeminjamanValues()
    {
        return self::KONFIRMASI_PINJAMAN_VALUES;
    }
    
    // Metode akses untuk mendapatkan nilai enum konfirmasi_kembali
    public static function getKonfirmasiKembaliValues()
    {
        return self::KONFIRMASI_KEMBALI_VALUES;
    }
}
