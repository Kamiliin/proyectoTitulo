<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['api_id', 'player_firstname', 'player_lastname', 'player_age', 'player_birthdate', 'player_countryorigin',
     'player_nationality', 'player_height', 'player_weight','player_photo','player_nameclub','player_logoclub',
     'player_position','player_captain','player_goals','player_goalsassists','player_duels',
     'player_duelswin','player_foulsdrawn','player_foulscommitted','player_yellow','player_red',
     'player_penaltyscored','player_penaltymissed','player_penaltysaved'];

}
