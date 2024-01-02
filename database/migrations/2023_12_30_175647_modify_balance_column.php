<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBalanceColumn extends Migration
{
    public function up():void
    {
        DB::statement("ALTER TABLE accounts MODIFY COLUMN balance INTEGER DEFAULT 0");
    }
}
