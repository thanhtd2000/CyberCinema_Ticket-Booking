<?php

namespace App\Http\Resources;

use App\Models\OrderSchedule;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'type' => $this->type()->get(),
            'room' => $this->room()->get('name'),
            'status' => OrderSchedule::where('schedule_id', $this->schedule_id)->where('seat_id', $this->id)->value('status'),
        ];
    }
}
