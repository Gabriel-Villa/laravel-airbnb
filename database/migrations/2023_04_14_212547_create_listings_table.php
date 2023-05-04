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
        Schema::create('listing', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->index()->comment("Name of the listing");
            $table->text('slug')->comment("Slug of the listing");
            $table->text('description')->nullable();
            $table->integer('roomCount')->default(1);
            $table->integer('bathroomCount')->default(1);
            $table->integer('guestCount')->default(1);
            $table->integer('price');

            $table->unsignedBigInteger('locationId');
            $table->foreign('locationId')->references('id')->on('location');

            $table->unsignedBigInteger('categoryId');
            $table->foreign('categoryId')->references('id')->on('category');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing');
    }
};
