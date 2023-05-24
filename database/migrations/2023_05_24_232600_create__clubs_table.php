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
        Schema::create('stadia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('name_club');
            $table->string('logo_club');
            $table->integer('founded_club');
            $table->string('country_club');
            $table->string('stadium_name');
            $table->string('stadium_address');
            $table->string('stadium_city');
            $table->integer('stadium_capacity');
            $table->string('stadium_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadia');
    }
};