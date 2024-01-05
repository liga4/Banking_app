<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up():void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('account_number')->unique()->nullable();
            $table->integer('balance')->default(0);
            $table->string('currency');
            $table->string('account_type')->default('Checking_account');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('accounts');
    }
}
