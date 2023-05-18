<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date,
            'director_id' => $this->director_id,
            'category_id' => $this->category_id,
            'trailer' => $this->trailer,
            'time' => $this->time,
            'language' => $this->language,
            'image' => $this->image,
            'price' => $this->price,
            'slug' => $this->slug,
            'isHot' => $this->isHot,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actor' => Movie::find($this->id)->actors()->pluck('actor_id', 'name')->toArray(),
        ];
    }
}
