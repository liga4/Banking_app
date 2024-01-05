<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoBalanceTable extends Migration
{
    public function up()
    {
        Schema::create('crypto_balance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('currency');
            $table->decimal('balance', 18, 12);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crypto_balance');
    }
}
