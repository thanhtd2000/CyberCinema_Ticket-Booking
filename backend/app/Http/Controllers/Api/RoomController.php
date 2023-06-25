<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomCollection;

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
        $seats = DB::table('seats')
            ->leftJoin('order_schedule', function ($join) use ($request) {
                $join->on('seats.id', '=', 'order_schedule.seat_id')
                    ->where('order_schedule.schedule_id', $request->schedule_id);
            })
            ->where('seats.room_id', $request->id)
            ->where('seats.status', 0)
            ->select('seats.id', 'seats.name', 'seats.type_id', 'order_schedule.status')
            ->get();
        $seats = $seats->map(function ($seat) {
            $seat->status = $seat->status ?? 0;
            return $seat;
        });
        $groupedSeats = $seats->groupBy(function ($seat) {
            return strtoupper(substr($seat->name, 0, 1));
        });

        $data = new RoomCollection($groupedSeats);
        return response()->json($data, 200);
    }
}
