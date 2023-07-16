<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowsResource;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ShowsController extends Controller
{
    public function index()
    {

        $order_code = Crypt::decrypt(request()->query('details', 0));

        $order = DB::table('orders')
            ->where('order_code', $order_code)
            ->first();
        $enOrderCode = Crypt::encrypt($order->order_code);
        $orderProducts = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('order_products.*', 'products.name')
            ->where('order_products.order_id', $order->id)
            ->where('order_products.status', '=', 1)
            ->get();

        $orderSchedules = DB::table('order_schedule')
            ->join('schedules', 'order_schedule.schedule_id', '=', 'schedules.id')

            ->join('movies', 'schedules.movie_id', '=', 'movies.id')
            ->join('rooms', 'schedules.room_id', '=', 'rooms.id')
            ->join('seats', 'order_schedule.seat_id', '=', 'seats.id')
            ->select('order_schedule.*', 'movies.name as movie_name', 'movies.time', 'schedules.time_start', 'rooms.name as room_name', 'seats.name as seat_name')
            ->where('order_schedule.order_id', $order->id)
            ->get();

        $orderDiscounts = DB::table('orders')
            ->leftJoin('discounts', 'orders.discount_id', '=', 'discounts.id')
            ->select('orders.*', 'discounts.*')
            ->where('orders.order_code', '=', $order_code)
            ->first();
        $orderTransaction =  DB::table('orders')
            ->join('transactions', 'orders.transaction_id', '=', 'transactions.id')
            ->select('transactions.*')
            ->where('orders.order_code', '=', $order_code)
            ->first();
        $seatNames = $orderSchedules->pluck('seat_name')->toArray();
        $seatNames = implode(', ', $seatNames);
        $timeStart = $orderSchedules[0]->time_start;
        $timeStartParts = explode(" ", $timeStart);
        $datePart = $timeStartParts[0]; // Ngày (YYYY-MM-DD)
        $timePart = $timeStartParts[1]; // Thời gian (HH:ii:ss)
        $productNames = implode(', ', $orderProducts->pluck('name')->toArray());


        // dd($orderSchedules);
        return view('index', compact('order', 'orderProducts', 'orderSchedules', 'orderDiscounts',  'seatNames', 'datePart', 'timePart', 'productNames',  'orderTransaction', 'enOrderCode'));
    }

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
                return $d;
            });
            return response()->json(ShowsResource::collection($detail), 200);
        }



        return response()->json('Not found', 404);
    }
}

// order_code, name_movie, room, schedule, seat, product, total