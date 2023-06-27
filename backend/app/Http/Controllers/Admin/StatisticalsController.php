<?php

namespace App\Http\Controllers\Admin;

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


        $orders = Orders::select(DB::raw('DATE(created_at) as order_date'), DB::raw('COUNT(*) as order_count'), 'total')
            ->groupBy(DB::raw('DATE(created_at)'), 'total')
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();


        $data = [
            'labels' => $orders->pluck('order_date'),
            'datasets' => [
                'label' => 'Doanh thu theo ngày',
                'data' => $orders->pluck('total'),
                'borderWidth' => 1
            ]
        ];

        return view('Admin/statisticals/index')->with('chartData', json_encode($data));
    }
}
