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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('media_manager');
            $table->timestamps();
        });

        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('media_manager');
            $table->timestamps();
        });

        Schema::create('inquiry', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('message');
            $table->string('location');
            $table->string('fencing_needed');
            $table->string('project_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
