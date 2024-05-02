<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalPengeluaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model
    protected $table = 'total_saldo';

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'total_saldo',
    ];
}
