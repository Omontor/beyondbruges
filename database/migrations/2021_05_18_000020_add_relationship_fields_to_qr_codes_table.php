<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQrCodesTable extends Migration
{
    public function up()
    {
        Schema::table('qr_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->foreign('partner_id', 'partner_fk_3842406')->references('id')->on('partners');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3842407')->references('id')->on('users');
        });
    }
}
