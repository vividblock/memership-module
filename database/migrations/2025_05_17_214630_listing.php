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
        Schema::create('listing_categories', function(Blueprint $table){
            $table->id();
            $table->string('categories_name');
            $table->string('categories_slug')->unique();
            $table->string('categories_icon')->nullable();
            $table->string('categories_iamge')->nullable();
            $table->timestamps();
        });

        Schema::create('listing_location', function(Blueprint $table){
            $table->id();
            $table->string('location_name');
            $table->string('location_slug')->unique();
            $table->string('location_latitude');
            $table->string('location_longititude');
            $table->string('location_google_address');
            $table->string('location_country');
            $table->string('location_zipcode')->nullable();
            $table->string('location_raw_date');
            $table->timestamps();
        });

        Schema::create('listing_tags', function(Blueprint $table){
            $table->id();
            $table->string('tag_name');
            $table->string('tag_slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_categories');
        Schema::dropIfExists('listing_location');
        Schema::dropIfExists('listing_tags');
    }
};
