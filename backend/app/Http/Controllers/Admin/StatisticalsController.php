<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d');
        $orderMonth = Orders::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as order_month'), DB::raw('SUM(total) AS total_sum'))
            ->where('status', 2)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->get();
        $orderDate = Orders::select(DB::raw('DATE(created_at) as order_month'), DB::raw('SUM(total) AS total_sum'))
        ->where('created_at','LIKE',"%$currentDateTime%")
        ->where('status', 2)
        ->groupBy(DB::raw('DATE(created_at)'))
        ->first();
    //    dd($orderDate);
        $data = [
            'labels' => $orderMonth->pluck('order_month'),
            'datasets' => [
                'label' => 'Doanh thu theo tháng',
                'data' => $orderMonth->pluck('total_sum'),
                'borderWidth' => 1
            ]
        ];
        $revenues = Movie::join('schedules', 'movies.id', '=', 'schedules.movie_id')
        ->join('order_schedule', 'schedules.id', '=', 'order_schedule.schedule_id')
        ->join('orders', 'order_schedule.order_id', '=', 'orders.id')
        ->where('orders.status', 2)
        ->select('movies.name', DB::raw('SUM(orders.total) as total_revenue'))
        ->groupBy('movies.name')
        ->orderByDesc('total_revenue')
        ->get();
    //    dd($revenues);
        return view('Admin/statisticals/index', compact('orderMonth','orderDate'))->with('chartData', json_encode($data));
    }

    public function showMonth(Request $request)
    {
        $dateString =$request->query('month');
        $carbonDate = Carbon::parse($dateString);

        $months = $carbonDate->month; // Kết quả: 7
        $year = $carbonDate->year; // Năm 2023
        $startDate = Carbon::createFromDate($year, $months, 1)->startOfDay();
        $endDate = Carbon::createFromDate($year, $months, 1)->endOfMonth()->endOfDay();

        $orders = Orders::select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total) AS total_sum'))
            ->where('status', 2)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('order_date')
            ->get();
         return response()->json(['month'=>$orders]);
    }
}
