<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoBalance extends Model
{
    use HasFactory;
    protected $table = 'crypto_balance';
    protected $fillable = [
        'user_id',
        'currency',
        'balance'
    ];
}
