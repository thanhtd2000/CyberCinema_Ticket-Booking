<?php

namespace App\Models;

use App\Models\Area;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'address',
    ];

    public function areas(): BelongsTo {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
