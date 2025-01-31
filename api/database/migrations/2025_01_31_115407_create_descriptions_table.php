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
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string( 'name', 255);
            $table->string( 'contact');
            $table->unsignedBigInteger('id_location');
            $table->unsignedBigInteger('id_openingTimes');
            $table->timestamps();

            $table->foreign('id_location')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('id_openingTimes')->references('id')->on('opening_times')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
