<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyExchangeRatesColumn extends Migration
{
    public function up():void
    {
        DB::statement("ALTER TABLE currency_exchange_rates MODIFY COLUMN exchange_rate DECIMAL(16, 10)");
    }
}
