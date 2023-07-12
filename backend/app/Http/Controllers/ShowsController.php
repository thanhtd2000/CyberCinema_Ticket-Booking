<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowsController extends Controller
{
    public function index()
    {
        $order_code = request()->query('details', 0);
        $order = DB::table('orders')
            ->where('order_code', $order_code)
            ->first();
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
        dd($orderSchedules);

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
        return view('index', compact('order', 'orderProducts', 'orderSchedules', 'orderDiscounts',  'seatNames', 'datePart', 'timePart', 'productNames',  'orderTransaction'));
    }
}
