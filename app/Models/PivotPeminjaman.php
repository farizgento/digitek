<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PivotPeminjaman extends Pivot
{
    use HasFactory;
    protected $table = 'pivot_peminjamans';
    protected $fillable = [
        'buku_id',
        'peminjaman_id',
    ];
}
