<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\OrderSchedule;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $room;
    public $seat;
    public function __construct(Room $room, Seat $seat)
    {
        $this->room = $room;
        $this->seat = $seat;
    }
    public function getSeats(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $seats = $this->seat->where('room_id', $request->id)->where('status', 0)->get();

        $seatsWithScheduleId = $seats->map(function ($seat) use ($schedule_id) {
            $seat['schedule_id'] = $schedule_id;
            return $seat;
        });

        $groupedSeats = $seatsWithScheduleId->groupBy(function ($seat) {
            return strtoupper(substr($seat['name'], 0, 1));
        });

        $data = [];
        foreach ($groupedSeats as $key => $seats) {
            $data[$key] = RoomResource::collection($seats);
        }

        return response()->json($data, 200);
    }
}
