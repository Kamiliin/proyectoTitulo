<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubFavorito extends Model
{
    use HasFactory;

    protected $table = 'club_favoritos';

    protected $fillable = [
        'club_id',
        'club_name',
        'user_id',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
