<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyExchangeRateColumn extends Migration
{
    public function up():void
    {
        Schema::table('crypto_exchange_rates', function (Blueprint $table) {
            $table->decimal('exchange_rate', 25, 16)->change();
        });
    }

    public function down()
    {
        Schema::table('crypto_exchange_rates', function (Blueprint $table) {
            //
        });
    }
}
