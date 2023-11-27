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
    public function buku(){
    
        return $this->hasMany(Buku::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class,'sekolah_id');
    }
}
