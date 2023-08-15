<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $schedule;
    public $movie;
    public $room;
    public function __construct(Schedule $schedule, Movie $movie, Room $room)
    {
        $this->schedule = $schedule;
        $this->movie = $movie;
        $this->room = $room;
    }

    public function getScheduleMovie(Request $request)
    {
        $currentTime = Carbon::now();
        $movie = $this->movie->where('slug', $request->slug)->first();
        $schedules = $this->schedule
            ->selectRaw('TIME_FORMAT(time_start, "%H:%i") as time')
            ->where('movie_id', $movie->id)
            ->whereRaw('DATE(time_start) = ?', [$request->date])
            ->where('time_start', '>', $currentTime)
            ->get();
        if (!empty($schedules->toArray())) {
            $data = ScheduleResource::collection($schedules);
            return response()->json($data, 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Không tìm thấy thông tin'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRooms(Request $request)
    {
        $movie = $this->movie->where('slug', $request->slug)->first();
        $date = Carbon::createFromFormat('Y-m-d H:i', $request->date . " " . $request->time);
        $dateTime = $date->format('Y-m-d H:i:s');
        $rooms = $this->schedule
            ->where('movie_id', $movie->id)
            ->where('time_start', $dateTime)
            ->get();
        $roomData = [];
        foreach ($rooms as $room) {
            $roomName = $this->room->find($room->room_id)->toArray();
            $schedule_id = $room->id;
            $roomName['schedule_id'] = $schedule_id;

            array_push($roomData, $roomName);
        }
        if (!empty($roomData)) {
            $data = ScheduleResource::collection($roomData);
            return response()->json($data, 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Không tìm thấy thông tin'
            ], 404);
        }
    }

}
