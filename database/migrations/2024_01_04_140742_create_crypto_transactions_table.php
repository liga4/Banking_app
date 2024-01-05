<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoTransactionsTable extends Migration
{
    public function up():void
    {
        Schema::create('crypto_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->string('currency');
            $table->decimal('amount',20, 10);
            $table->decimal('buying_price', 35, 25);
            $table->string('category');
            $table->integer('boughtFor');
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('crypto_transactions');
    }
}
