<?php

namespace App\Models;

use App\Models\Director;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    
    // public function actors(): HasMany {
    //     return $this->hasMany(Actor::class, 'actor_id');
    // }

    // public function directors(): HasMany {
    //     return $this->hasMany(Director::class, 'director_id');
    // }
    
}