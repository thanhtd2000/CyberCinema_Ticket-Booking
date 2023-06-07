<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public $movie;
    public $room;
    public $schedule;
    public $convert;

    public function __construct(Movie $movie, Room $room, Schedule $schedule)
    {
        $this->movie = $movie;
        $this->room = $room;
        $this->schedule = $schedule;
        $this->convert = new GlobalHelper();
    }

    public function index()
    {
        $rooms = $this->room->get();
        $movies = $this->movie->get();
        $schedules = $this->schedule->get();
        return view('admin.schedule.list', compact('rooms', 'movies', 'schedules'));
    }

    public function create()
    {
        $rooms = $this->room->get();
        $movies = $this->movie->get();
        return view('admin.schedule.create', compact('rooms', 'movies'));
    }

    public function store(Request $request)
    {
        // dd($request->time_start);
        $request->validate([
            'movie_id' => 'required',
            'room_id' => 'required',
            'time_start' => 'required',
        ]);
       $movie = $this->movie->find($request->movie_id);
       $start_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->time_start);
    //    dd($start_time->format('Y/m/d H:i:s'));
        $time_end = $this->convert->convertStringToHoursMinutes($movie->time, $start_time->format('Y/m/d H:i:s'));
        $insert = [
            'room_id' => $request->room_id,
            'movie_id' => $request->movie_id,
            'time_start' => $start_time,
            'time_end' => $time_end
        ];
        Schedule::create($insert);

        return redirect()->route('admin.schedule');
    }

    public function edit($id)
    {
        $rooms = $this->room->get();
        $movies = $this->movie->get();
        $schedule = Schedule::find($id);
        return view('admin.schedule.edit', compact('schedule', 'rooms', 'movies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required',
            'room_id' => 'required',
            'time_start' => 'required',
        ]);

        $insert = [
            'room_id' => $request->room_id,
            'movie_id' => $request->movie_id,
            'time_start' => $request->time_start,
        ];

        Schedule::find($id)->update($insert);

        return redirect()->route('admin.schedule');
    }

    public function delete($id)
    {
        Schedule::find($id)->delete();
        return back()->with('message', 'Xóa thành công');
    }
}
