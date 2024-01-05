<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'account_id',
        'currency',
        'amount',
        'buying_price',
        'category',
        'boughtFor'
    ];
}
