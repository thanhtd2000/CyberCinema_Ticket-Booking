<?php

namespace App\Http\Controllers\Api;

use App\Models\Seat;
use Illuminate\Http\Request;
use App\Models\OrderSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeatResource;

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
            $data1 = DB::table('seats')->leftJoin('seat_types', 'seat_types.id', '=', 'seats.type_id')
                ->leftJoin('order_schedule', 'order_schedule.seat_id', '=', 'seats.id')
                ->where('seats.id', $data->seat_id)
                ->select('seats.id', 'seats.name', 'seat_types.price', 'order_schedule.status')->get();
            return response()->json(SeatResource::collection($data1), 200);
        } else {
            $data1 =  OrderSchedule::where('seat_id', $request->id)
                ->where('schedule_id', $request->schedule_id)
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->delete();
            if (empty($data1)) {
                return response()->json(['message' => 'Ghế đã bị đặt', 'status_code' => 404], 404);
            }

            return response()->json(['message' => 'Đổi trạng thái thành công', 'status_code' => 202], 202);
        }
        // $seats = DB::table('seats')
        //     ->leftJoin('order_schedule', function ($join) use ($data) {
        //         $join->on('seats.id', '=', 'order_schedule.seat_id')
        //             ->where('order_schedule.schedule_id', $data->schedule_id);
        //     })
        //     ->where('seats.room_id', $data->schedule->room_id)
        //     ->select('seats.id', 'seats.name', 'seats.type_id', 'order_schedule.status')
        //     ->get();
        // $seats = $seats->map(function ($seat) {
        //     $seat->status = $seat->status ?? 0;
        //     return $seat;
        // });
        // $groupedSeats = $seats->groupBy(function ($seat) {
        //     return strtoupper(substr($seat->name, 0, 1));
        // });

        // $data1 = SeatResource::collection($data);
        // return response()->json($data1, 200);
    }
}
