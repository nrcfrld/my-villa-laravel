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

        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('short_description');
            $table->decimal('base_price_idr', 15,2);
            $table->integer('max_occupants_pax');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('area_sqm')->nullable();
            $table->string('location_district', 255);
            $table->string('google_maps_url', 2048)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
