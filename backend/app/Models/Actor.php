<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actor');
    }
}