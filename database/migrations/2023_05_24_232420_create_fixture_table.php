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
        // En la migración create_fixtures_table
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('home_team_name');
            $table->string('home_team_logo');
            $table->string('away_team_name');
            $table->string('away_team_logo');
            $table->dateTime('date');
            $table->string('status');
            $table->string('venue');
            $table->timestamps();
        });
    }



    
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};