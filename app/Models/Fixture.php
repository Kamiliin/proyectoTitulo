<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = ['api_id', 'home_team_name', 'home_team_logo', 'away_team_name', 'away_team_logo', 'date', 'status', 'venue'];

}