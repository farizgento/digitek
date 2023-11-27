<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBuku extends Model
{
    use HasFactory;
    protected $fillable = [
        'lokasi',
        'sekolah_id',
    ];
    public function buku(){
    
        return $this->hasOne(Buku::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class,'sekolah_id');
    }
}
