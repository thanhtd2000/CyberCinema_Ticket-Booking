<?php

namespace App\Models;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'transactions_code',
        'bank_code',
        'payment_code',
        'status',
        'amount',
        'order_code',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Orders::class, 'transaction_id');
    }
}