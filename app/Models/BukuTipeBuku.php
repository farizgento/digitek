<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PivotBukuTipeBuku extends Pivot
{
    use HasFactory;
    protected $table = 'pivot_buku_tipe_bukus'; // sesuaikan dengan nama tabel sesuai kebutuhan

}
