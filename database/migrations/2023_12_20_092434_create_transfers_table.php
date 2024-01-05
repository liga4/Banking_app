<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up():void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users');
            $table->unsignedBigInteger('sender_account_id');
            $table->foreign('sender_account_id')->references('id')->on('accounts');
            $table->unsignedBigInteger('recipient_account_id');
            $table->foreign('recipient_account_id')->references('id')->on('accounts');
            $table->string('reference')->index('transfer_reference_index');
            $table->decimal('amount', 16, 4);
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down():void
    {
        Schema::dropIfExists('transfers');
    }
}
