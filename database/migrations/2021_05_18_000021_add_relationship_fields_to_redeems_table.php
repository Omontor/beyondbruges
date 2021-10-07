<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRedeemsTable extends Migration
{
    public function up()
    {
        Schema::table('redeems', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_3842451')->references('id')->on('users');
            $table->unsignedBigInteger('prize_id');
            $table->foreign('prize_id', 'prize_fk_3842452')->references('id')->on('prizes');
        });
    }
}
