<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function type()
    {
        return $this->belongsTo(SeatType::class, 'type_id');
    }
}
