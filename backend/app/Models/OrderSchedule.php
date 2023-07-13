<?php

namespace App\Models;

use App\Models\Seat;
use App\Models\User;
use App\Models\Orders;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderSchedule extends Model
{
    use HasFactory;
    protected $table = 'order_schedule';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }
}