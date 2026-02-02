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
        Schema::create('media_manager', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('testimonial', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('message');
            $table->string('location');
            $table->string('designation'); 
            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('media_manager');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial');
    }
};
