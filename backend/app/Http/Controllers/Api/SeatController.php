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
        $user = $request->user();
        $count = OrderSchedule::where('user_id', $user->id)->where('schedule_id', $request->schedule_id)->where('status', 1)->count();
        $seat = OrderSchedule::where('seat_id', $request->id)->where('schedule_id', $request->schedule_id)->first();
        if ($seat == null) {
            if ($count <= 4) {
                $data = OrderSchedule::create([
                    'seat_id' => $request->id,
                    'schedule_id' => $request->schedule_id,
                    'user_id' => $user->id,
                    'status' => 1,
                    'total' => $request->total

                ]);
                $data1 = Seat::leftJoin('seat_types', 'seat_types.id', '=', 'seats.type_id')
                    ->leftJoin('order_schedule', 'order_schedule.seat_id', '=', 'seats.id')
                    ->where('seats.id', $data->seat_id)
                    ->select('seats.id', 'seats.name', 'seat_types.price', 'order_schedule.status')
                    ->first();
                return response()->json(new SeatResource($data1), 200);
            }
            return response()->json([
                'message' => 'Bạn chỉ được phép đặt tối đa 5 ghế trong một lịch',
                'status_code' => 401
            ], 401);
        } else {
            $data1 =  OrderSchedule::where('seat_id', $request->id)
                ->where('schedule_id', $request->schedule_id)
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->forceDelete();
            if (empty($data1)) {
                return response()->json(['message' => 'Ghế đã bị đặt', 'status_code' => 404], 404);
            }

            return response()->json(['message' => 'Đổi trạng thái thành công', 'status_code' => 202], 202);
        }
    }
}
