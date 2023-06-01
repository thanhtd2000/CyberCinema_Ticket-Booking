<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public $seat;
    public function __construct(Seat $seat)
    {
        $this->seat =$seat; 
    }

    public function edit(Request $request)
    {
        
        $seat = $this->seat->find($request->id);
        
        return response()->json(['seat'=>$seat]);
    }
}
