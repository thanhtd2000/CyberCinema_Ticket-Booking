<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\OrderSchedule;
use App\Http\Controllers\Controller;
use Google\Cloud\Storage\Connection\Rest;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatusSeat(Request $request)
    {
        $user = $request->user();
        $seat = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->first();
        if ($seat == null) {
            $data = OrderSchedule::create([
                'seat_id' => $request->id,
                'schedule_id' => $request->schedule_id,
                'user_id' => $user->id,
                'status' => $request->status
            ]);
            return response()->json($data, 200);
        } else {
            // $seat->status = $request->status;
            $datas = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->where('user_id', $user->id)->update([
                'status' => $request->status
            ]);
            if ($datas == 0) {
                return response()->json(['message' => 'Ghế đã bị đặt', 'status_code' => 404], 404);
            }
            $data = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->first();
            return response()->json($data, 200);
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