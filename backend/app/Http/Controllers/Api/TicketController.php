<?php

namespace App\Http\Controllers\Api;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShowsResource;
use Illuminate\Support\Facades\Crypt;

class TicketController extends Controller
{
    public function listTickets(Request $request)
    {
        // dd($request->user());
        $user = $request->user();
        $data = Orders::where('user_id', $user->id)->get();
        if (!empty($data->toArray())) {

            $detail = $data->map(function ($d) {

                $d->seat_name =  DB::table('order_schedule')
                    ->join('seats', 'order_schedule.seat_id', '=', 'seats.id')
                    ->select('seats.name as name')
                    ->where('order_schedule.order_id', $d->id)
                    ->get()->pluck('name');
                $d->product_name = DB::table('order_products')
                    ->join('products', 'order_products.product_id', '=', 'products.id')
                    ->select('products.name as name')
                    ->where('order_products.order_id', $d->id)
                    ->get()->pluck('name');
                $orderSchedules = DB::table('order_schedule')
                    ->join('schedules', 'order_schedule.schedule_id', '=', 'schedules.id')
                    ->join('movies', 'schedules.movie_id', '=', 'movies.id')
                    ->join('rooms', 'schedules.room_id', '=', 'rooms.id')
                    ->select('movies.name as movie_name', 'schedules.time_start as time_start', 'rooms.name as room_name')
                    ->where('order_schedule.order_id', $d->id)
                    ->first();
                $d->room_name = $orderSchedules->room_name;
                $d->time_start = $orderSchedules->time_start;
                $d->movie_name = $orderSchedules->movie_name;
                $d->addPoints = ceil($d->total / 10000);
                if ($d->status == 1) {
                    $d->link = "http://127.0.0.1:8000/bill?details=" . Crypt::encrypt($d->order_code);
                }
                return $d;
            });
            return response()->json(ShowsResource::collection($detail), 200);
        }
        return response()->json('Not found', 404);
    }
}
