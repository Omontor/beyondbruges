<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryLandmarkPivotTable extends Migration
{
    public function up()
    {
        Schema::create('itinerary_landmark', function (Blueprint $table) {
            $table->unsignedBigInteger('itinerary_id');
            $table->foreign('itinerary_id', 'itinerary_id_fk_3927928')->references('id')->on('itineraries')->onDelete('cascade');
            $table->unsignedBigInteger('landmark_id');
            $table->foreign('landmark_id', 'landmark_id_fk_3927928')->references('id')->on('landmarks')->onDelete('cascade');
        });
    }
}
