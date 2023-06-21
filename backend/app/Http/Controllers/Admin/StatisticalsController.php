<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'labels' => ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 's', 's', 'd'],
            'datasets' => [
                'label' => 'Doanh thu',
                'data' => [1, 19, 8, 5, 2, 3, 5, 3, 2],
                'borderWidth' => 1
            ]
        ];

        return view('Admin/statisticals/index')->with('chartData', json_encode($data));
    }
    
}