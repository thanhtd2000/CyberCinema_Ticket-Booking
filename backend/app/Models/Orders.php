<?php

namespace App\Models;

use App\Models\User;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];
    protected $fillable = [
        'total',
        'user_id',
        'discount_id',
        'transaction_id',
        'order_code',
        'status',
    ];


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