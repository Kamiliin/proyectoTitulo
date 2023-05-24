<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['api_id', 'name', 'logo', 'rank', 'points', 'goals_diff', 'played', 'win', 'draw', 'lose'];

}

