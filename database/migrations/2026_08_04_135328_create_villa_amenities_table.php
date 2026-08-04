<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('villa_amenities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('villa_id')->unsigned()->index();
            $table->bigInteger('amenity_id')->unsigned()->index();

            $table->foreign('villa_id')->references('id')->on('villas');
            $table->foreign('amenity_id')->references('id')->on('amenities');

            $table->unique(['villa_id', 'amenity_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_amenities');
    }
};
