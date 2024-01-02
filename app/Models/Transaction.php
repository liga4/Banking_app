<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'reference',
        'user_id',
        'account_id',
        'amount',
        'category',
        'date'
    ];
    public function owner() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
//    public function delete()
//    {
//        Transaction::whereIn('id', [46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60])->delete();
//    }
}
