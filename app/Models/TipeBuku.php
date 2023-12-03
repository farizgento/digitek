<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeBuku extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'sekolah_id',
    ];
    // public function buku(){
    
    //     return $this->hasMany(Buku::class);
    // }

    // Relasi dengan tabel pivot
    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'buku_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class,'sekolah_id');
    }
}
