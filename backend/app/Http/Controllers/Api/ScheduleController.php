<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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
    public function __construct(Schedule $schedule, Movie $movie)
    {
        $this->schedule = $schedule;
        $this->movie = $movie;
    }

    public function getScheduleMovie(Request $request)
    {
        $currentTime = Carbon::now();
       $movie = $this->movie->where('slug', $request->slug)->first();
       $schedules = $this->schedule->selectRaw('DATE(time_start) as date')->where('movie_id', $movie->id)->where('time_start','>',$currentTime)->groupBy('date')->get();
       $schedules -> pluck('date');
       if(!empty($schedules->toArray())){
        $data = ScheduleResource::collection($schedules);
        return response()->json($data,200);
       }else{
        return response()->json([
            'status_code' => 404,
            'message' => 'Item Not Found'
        ], 404);
       }
      

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
        //
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
