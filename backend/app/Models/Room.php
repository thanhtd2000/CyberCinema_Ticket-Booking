<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function seats()
    {
        return $this->hasMany(Seat::class, 'room_id');
    }
}
