<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Director;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'date',
        'director_id',
        'category_id',
        'trailer',
        'time',
        'language',
        'image',
        'price',
        'slug',
        'isHot',
        'year_old',
        'type'
    ];



    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_movies', 'movie_id', 'actor_id');
    }
    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
