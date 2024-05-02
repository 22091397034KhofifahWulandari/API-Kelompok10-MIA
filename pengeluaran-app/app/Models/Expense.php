<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'description', 'amount', 'date', 'user_id'];

    // Relasi antara Expense dan User (pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
