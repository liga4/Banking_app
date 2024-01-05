<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoExchangeRates extends Migration
{
    public function up():void
    {
        Schema::create('crypto_exchange_rates', function (Blueprint $table) {
            $table->string('currency')->primary();
            $table->decimal('exchange_rate', 35, 25);
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
