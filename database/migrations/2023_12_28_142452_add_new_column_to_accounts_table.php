<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToAccountsTable extends Migration
{
    public function up():void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('currency');
        });
    }
}
