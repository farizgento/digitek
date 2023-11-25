<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
    ];
    
    public function user(){
    
        return $this->hasOne(User::class);
    }
    public function buku(){
    
        return $this->hasOne(Buku::class);
    }
}
