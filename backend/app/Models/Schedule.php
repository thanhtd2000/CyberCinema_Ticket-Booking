<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
