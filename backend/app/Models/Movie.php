<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Director;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use HasFactory, Searchable;
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
    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'movie_id');
    }
    public function toSearchableArray()
    {
        return [
            'name' => $this->name
        ];
    }
}
