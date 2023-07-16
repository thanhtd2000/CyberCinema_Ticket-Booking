<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $guarded = [];



    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function products()
    {
        return $this->hasMany(Products::class, 'product_id');
    }
}
