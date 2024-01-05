<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeRatesTable extends Migration
{
    public function up():void
    {
        Schema::create('Currency_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->primary();
            $table->decimal('exchange_rate', 10, 6);
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('_currency_exchange_rates');
    }
}
