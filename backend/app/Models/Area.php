<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function cinemas() {
        return $this->hasMany(Cinema::class, 'area_id');
    }
}
