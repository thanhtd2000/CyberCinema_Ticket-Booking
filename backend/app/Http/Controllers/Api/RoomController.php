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
        // dd($schedule_id);
        $seats = $this->seat->where('room_id', $request->room_id)->where('status', 0)->get();
        $seatsWithScheduleId = $seats->map(function ($seat) use ($schedule_id) {
            $seat['schedule_id'] = $schedule_id;
            return $seat;
        });
        $data = RoomResource::collection($seatsWithScheduleId);

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
