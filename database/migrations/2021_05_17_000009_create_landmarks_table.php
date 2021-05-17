<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    public function up()
    {
        Schema::create('landmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->longText('description_a')->nullable();
            $table->longText('description_b')->nullable();
            $table->longText('description_c')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
