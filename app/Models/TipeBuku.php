<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeBuku extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];
    public function buku(){
    
        return $this->hasMany(Buku::class);
    }
}
