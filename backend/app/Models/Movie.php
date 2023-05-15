<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Director;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
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
        'price'
    ];



    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_movies');
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
