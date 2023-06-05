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

    public function edit($id)
    {
        
        $seat = $this->seat->find($id);
        
        return response()->json(['seat'=>$seat]);
    }

    public function update(Request $request, )
    {
        $seat = Seat::find($request->id);
        if($seat){
            // $seat->name = $request->input('name');
            $seat->type_id = $request->input('type_id');
            $seat->update();
            return response()->json([
                'status' => 200,
                'message' =>'Cập nhật ghế thành công',
            ]);
            
        }
        else {
            return response()->json([
                'status' => 404,
                'message' =>'Không tìm thấy ghế',
            ]);
        }
    }
}
