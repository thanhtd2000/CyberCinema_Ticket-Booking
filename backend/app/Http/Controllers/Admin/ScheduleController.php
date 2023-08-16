<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

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
        $schedules = $this->schedule->paginate(10);
        return view('Admin.schedule.list', compact('rooms', 'movies', 'schedules'));
    }

    public function create()
    {
        if (Gate::allows('create-schedule')) {
            $rooms = $this->room->get();
            $movies = $this->movie->get();
            return view('Admin.schedule.create', compact('rooms', 'movies'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required',
            'room_id' => 'required',
            'time_start' => 'required',
        ]);
        $time_starts = $request->time_start;

        $movie = $this->movie->find($request->movie_id);
        $messages = [];
        $errors = [];
        foreach ($time_starts as $time) {
            $start_time = Carbon::createFromFormat('Y-m-d\TH:i', $time);
            $time_end = $this->convert->convertStringToHoursMinutes($movie->time,  $start_time->format('Y/m/d H:i:s'));
            $insert = [
                'room_id' => $request->room_id,
                'movie_id' => $request->movie_id,
                'time_start' => $start_time,
                'time_end' => $time_end
            ];
            $formatEndtime =   $time_end->format('Y/m/d H:i:s');
            $formatStarttime = $start_time->format('Y/m/d H:i:s');
            $schedule = $this->schedule->where('room_id', $request->room_id)->where('time_start', '<=',  $formatStarttime)->where('time_end', '>=',  $formatStarttime)->first();
            $schedule2 = $this->schedule->where('room_id', $request->room_id)->where('time_start', '<=',  $formatEndtime)->where('time_end', '>=',  $formatEndtime)->first();
            $schedule3 = $this->schedule->where('room_id', $request->room_id)->where('time_start', '>=',  $formatStarttime)->where('time_end', '<=',  $formatEndtime)->first();
            if (!empty($schedule) || !empty($schedule2) || !empty($schedule3)) {
                array_push($errors, "Phòng không trống trong khoảng thời gian  $start_time !");
            } else {
                Schedule::create($insert);
                array_push($messages, "Thêm thành công $start_time !");
            }
        }
        $error = implode("</br>", $errors);
        $message = implode("</br>", $messages);
        return redirect()->route('admin.schedule')->with('errors', $error)->with('message', $message);
    }

    public function edit($id)
    {
        if (Gate::allows('edit-schedule')) {
            $rooms = $this->room->get();
            $movies = $this->movie->get();
            $schedule = Schedule::find($id);
            return view('Admin.schedule.edit', compact('schedule', 'rooms', 'movies'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required',
            'room_id' => 'required',
            'time_start' => 'required',
        ]);

        $start_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->time_start);

        $movie = $this->movie->find($request->movie_id);
        $time_end = $this->convert->convertStringToHoursMinutes($movie->time, $start_time->format('Y/m/d H:i:s'));
        $formatEndtime =   $time_end->format('Y/m/d H:i:s');
        $formatStarttime =  $start_time->format('Y/m/d H:i:s');
        $insert = [
            'room_id' => $request->room_id,
            'movie_id' => $request->movie_id,
            'time_start' => $start_time,
            'time_end' => $time_end
        ];

        $schedule = $this->schedule->where('room_id', $request->room_id)->where('time_start', '<=',  $formatStarttime)->where('time_end', '>=',  $formatStarttime)->get();
        $schedule2 = $this->schedule->where('room_id', $request->room_id)->where('time_start', '<=',  $formatEndtime)->where('time_end', '>=',  $formatEndtime)->get();
        $schedule3 = $this->schedule->where('room_id', $request->room_id)->where('time_start', '>=',  $formatStarttime)->where('time_end', '<=',  $formatEndtime)->get();
        if (!empty($schedule->toArray()) || !empty($schedule2->toArray()) || !empty($schedule3->toArray())) {
            return back()->with('errors', 'Phòng không trống trong khoảng thời gian này!');
        } else {
            Schedule::find($id)->update($insert);
            return redirect()->route('admin.schedule')->with('message', 'Sửa thành công!');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('delete-schedule')) {
            Schedule::find($id)->delete();
            return back()->with('message', 'Xóa thành công');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }

    public function checktime(Request $request)
    {
        $room_id = $request->room_id;
        $date = $request->date;
        $time = $this->schedule
            ->where('room_id', $room_id)
            ->whereDate('time_start', $date)
            ->select(DB::raw("DATE_FORMAT(time_start, '%H:%i') as time_start"), DB::raw("DATE_FORMAT(time_end, '%H:%i') as time_end"))
            ->get();
        return response()->json($time, 200);
    }
}
