<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Schedule;
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
            ->where('created_at', 'LIKE', "%$currentDateTime%")
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
        $revenues = Movie::leftJoin('schedules', 'movies.id', '=', 'schedules.movie_id')
        ->leftJoin('order_schedule', function ($join) {
            $join->on('schedules.id', '=', 'order_schedule.schedule_id')
                 ->where('order_schedule.status', '=', 2);
        })
        ->groupBy('movies.id', 'movies.name') // Group by movie id and name
        ->select('movies.*', DB::raw('SUM(IFNULL(order_schedule.total, 0)) as total_revenue'))
        ->orderByDesc('total_revenue')
        ->get();
        $products = Product::with(['orderProducts' => function ($query) {
            $query->where('status', 2);
        }])->get();
        
       
        return view('Admin/statisticals/index', compact('orderMonth', 'orderDate','revenues','products'))->with('chartData', json_encode($data));
    }

    public function showMonth(Request $request)
    {
        $dateStart = $request->query('dateStart');
        $dateEnd = $request->query('dateEnd');

        if ($dateStart && $dateEnd) {
            $orderDate = Orders::whereBetween('created_at', [$dateStart, $dateEnd])
                 ->where('status', 2)
                ->select(DB::raw('SUM(total) AS total'))
                
                ->first();
            return response()->json(['orderDate' => $orderDate]);
        } elseif ($dateEnd) {
            $orderDate = Orders::select(DB::raw('SUM(total) AS total'))
                ->where('created_at', 'LIKE', "%$dateEnd%")
                ->where('status', 2)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->first();
            return response()->json(['orderDate' => $orderDate]);
        } elseif ($dateStart) {

            $orderDate = Orders::select(DB::raw('SUM(total) AS total'))
                ->where('created_at', 'LIKE', "%$dateStart%")
                ->where('status', 2)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->first();
            return response()->json(['orderDate' => $orderDate]);
        }
    }
}
