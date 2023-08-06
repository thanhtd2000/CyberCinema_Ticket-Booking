<?php

namespace App\Models;

use App\Models\OrderProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function orderProducts()
{
    return $this->hasMany(OrderProducts::class, 'product_id');
}
}
