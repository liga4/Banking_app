<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoExchangeRates extends Model
{
    use HasFactory;

    protected $primaryKey = 'currency';
    protected $fillable = [
        'currency',
        'exchange_rate'
    ];
}
