<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
