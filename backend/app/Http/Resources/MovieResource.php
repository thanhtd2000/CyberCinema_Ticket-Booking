<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'director' => $this->director()->get(),
            'category' => $this->category()->get(),
            'trailer' => $this->trailer,
            'time' => $this->time,
            'language' => $this->language,
            'image' => $this->image,
            'price' => (int)$this->price,
            'slug' => $this->slug,
            'isHot' => $this->isHot,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actor' => $this->actors()->get(),
            'year_old' => $this->year_old,
            'type' => $this->type,
        ];
    }
}
