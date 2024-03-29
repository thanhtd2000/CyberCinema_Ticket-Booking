<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;
use App\Models\OrderSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;

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
        $seats = Seat::leftJoin('order_schedule', function ($join) use ($request) {
            $join->on('seats.id', '=', 'order_schedule.seat_id')
                ->where('order_schedule.schedule_id', $request->schedule_id)
                ->whereNull('order_schedule.deleted_at');
        })
            ->leftJoin('seat_types', 'seat_types.id', '=', 'seats.type_id')
            ->where('seats.room_id', $request->id)
            ->where('seats.status', 0)
            ->select('seats.id', 'seats.name', 'seats.type_id', 'order_schedule.status', 'seat_types.price')
            ->get();
        $seats = $seats->map(function ($seat) {
            $seat->status = (int)$seat->status ?? 0;
            $seat->type_id = (int)$seat->type_id;
            $seat->price = (int)$seat->price;
            return $seat;
        });
        $groupedSeats = $seats->groupBy(function ($seat) {
            return strtoupper(substr($seat->name, 0, 1));
        });

        $data = new RoomCollection($groupedSeats);
        return response()->json($data, 200);
    }
}
