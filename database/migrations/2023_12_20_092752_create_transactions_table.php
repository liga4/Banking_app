<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up():void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index('transaction_reference_index');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->decimal('amount', 16, 4);
            $table->string('category');
            $table->boolean('confirmed')->default(0);
            $table->string('description');
            $table->dateTime('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('transactions');
    }
}
