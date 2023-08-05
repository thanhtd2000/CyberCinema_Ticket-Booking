<?php

namespace App\Models;

use App\Models\User;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_schedule()
    {
        return $this->hasMany(OrderSchedule::class, 'order_id');
    }
    public function order_products()
    {
        return $this->hasMany(OrderProducts::class, 'order_id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}