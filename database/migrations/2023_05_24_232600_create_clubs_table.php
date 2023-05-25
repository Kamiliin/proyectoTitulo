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
        // En la migración create_clubs_table
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->unsignedBigInteger('rank');
            $table->string('name');
            $table->string('logo');
            $table->unsignedBigInteger('points');
            $table->Integer('goals_diff');
            $table->Integer('played');
            $table->Integer('win');
            $table->Integer('draw');
            $table->Integer('lose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};