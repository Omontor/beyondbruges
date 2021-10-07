<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCouponRedeemsTable extends Migration
{
    public function up()
    {
        Schema::table('coupon_redeems', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5055406')->references('id')->on('users');
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id', 'coupon_fk_5055407')->references('id')->on('coupons');
        });
    }
}
