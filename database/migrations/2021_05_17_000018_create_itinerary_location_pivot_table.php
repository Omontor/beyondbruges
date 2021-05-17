<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryLocationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('itinerary_location', function (Blueprint $table) {
            $table->unsignedBigInteger('itinerary_id');
            $table->foreign('itinerary_id', 'itinerary_id_fk_3842405')->references('id')->on('itineraries')->onDelete('cascade');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id', 'location_id_fk_3842405')->references('id')->on('locations')->onDelete('cascade');
        });
    }
}
