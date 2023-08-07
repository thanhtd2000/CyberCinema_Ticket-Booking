<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => RoomResource::collection($this->collection),
            
            'time' =>   Carbon::createFromFormat('H:i:s', Carbon::now()->addMinute(10)->format('H:i:s'))->timestamp * 1000
        ];
    }
}
