<?php

namespace App\Models;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $guarded = [];

    protected $fillable = [
        'code',
        'start_time',
        'and_time',
        'percent',
        'description',
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Orders::class, 'discount_id', 'id');
    }
}