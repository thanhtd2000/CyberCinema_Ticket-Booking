<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Movie;
use App\Models\OrderSchedule;
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
    public function orderSchedule()
    {
        return $this->hasMany(OrderSchedule::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
