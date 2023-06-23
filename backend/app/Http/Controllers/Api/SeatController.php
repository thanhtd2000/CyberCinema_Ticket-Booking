<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\OrderSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatusSeat(Request $request)
    {
        // dd($request);
        $user = $request->user();
        $seat = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->first();
        if ($seat == null) {
            $data = OrderSchedule::create([
                'seat_id' => $request->id,
                'schedule_id' => $request->schedule_id,
                'user_id' => $user->id,
                'status' => 1
            ]);
        } else {
            $datas = OrderSchedule::where('seat_id', $request->id)
                ->where('schedule_id', $request->schedule_id)
                ->where('user_id', $user->id)
                ->update([
                    'status' => DB::raw('IF(status = 0, 1, 0)')
                ]);
            if ($datas == 0) {
                return response()->json(['message' => 'Ghế đã bị đặt', 'status_code' => 404], 404);
            }
            $data = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->first();
        }

        $seats = DB::table('seats')
            ->leftJoin('order_schedule', function ($join) use ($data) {
                $join->on('seats.id', '=', 'order_schedule.seat_id')
                    ->where('order_schedule.schedule_id', $data->schedule_id);
            })
            ->where('seats.room_id', $data->schedule->room_id)
            ->select('seats.id', 'seats.name', 'seats.type_id', 'order_schedule.status')
            ->get();
        $seats = $seats->map(function ($seat) {
            $seat->status = $seat->status ?? 0;
            return $seat;
        });
        $groupedSeats = $seats->groupBy(function ($seat) {
            return strtoupper(substr($seat->name, 0, 1));
        });

        $data = RoomResource::collection($groupedSeats);
        return response()->json($data, 200);
    }
}
