<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('player_firstname');
            $table->string('player_lastname');
            $table->integer('player_age');
            $table->date('player_birthdate');
            $table->string('player_countryorigin');
            $table->string('player_nationality');
            $table->integer('player_height');
            $table->integer('player_weight');
            $table->string('player_photo');
            $table->string('player_nameclub');
            $table->string('player_logoclub');
            $table->string('player_position');
            $table->string('player_captain');
            $table->integer('player_goals');
            $table->integer('player_goalsassists');
            $table->integer('player_duels');
            $table->integer('player_duelswin');
            $table->integer('player_foulsdrawn');
            $table->integer('player_foulscommitted');
            $table->integer('player_yellow');
            $table->integer('player_red');
            $table->integer('player_penaltyscored');
            $table->integer('player_penaltymissed');
            $table->integer('player_penaltysaved');
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
