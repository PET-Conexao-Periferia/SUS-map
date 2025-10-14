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
        Schema::create('addresses', function (Blueprint $table) {
            $table->foreignId('description_id')
                ->references('location_id')
                ->on('descriptions')
                ->onDelete('cascade');
            $table->primary('description_id');
            $table->string('street');
            $table->integer('number');
            $table->string('district');
            $table->string('cep', 9);
            $table->string('reference', 400)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
