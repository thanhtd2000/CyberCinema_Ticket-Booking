<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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

        // $orders = Orders::select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total) AS total_sum'))
        //     ->where('status', 2)
        //     ->groupBy(DB::raw('DATE(created_at)'))
        //     ->get();
        $orderMonth = Orders::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as order_month'), DB::raw('SUM(total) AS total_sum'))
            ->where('status', 2)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->get();
        // dd($orderMonth);
        foreach ($orderMonth as $months) {
            $dateString = $months->order_month;
            $carbonDate = Carbon::parse($dateString);

            $month = $carbonDate->month; // Kết quả: 7
            $year = $carbonDate->year; // Năm 2023
            // dd($year);

            $startDate = Carbon::createFromDate($year, $month, 1)->startOfDay();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

            $orders = Orders::select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total) AS total_sum'))
                ->where('status', 2)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('order_date')
                ->get();
        }
        // dd($orders);
        $data = [
            'labels' => $orderMonth->pluck('order_month'),
            'datasets' => [
                'label' => 'Doanh thu theo tháng',
                'data' => $orderMonth->pluck('total_sum'),
                'borderWidth' => 1
            ]
        ];

        return view('Admin/statisticals/index', compact('orders', 'orderMonth'))->with('chartData', json_encode($data));
    }

    public function showMonth(Request $request)
    {
        $dateString =$request->query('month');
        $carbonDate = Carbon::parse($dateString);

        $months = $carbonDate->month; // Kết quả: 7
        $year = $carbonDate->year; // Năm 2023
        // dd($year);

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
