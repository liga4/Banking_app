<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToAccountsTable2 extends Migration
{
    public function up():void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('account_type')->default('Checking_account');
        });
    }
}
