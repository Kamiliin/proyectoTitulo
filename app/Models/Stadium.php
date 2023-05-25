<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = ['api_id', 'name_club', 'logo_club', 'founded_club', 'country_club', 'stadium_name', 'stadium_address', 'stadium_city', 'stadium_capacity', 'stadium_image'];

}