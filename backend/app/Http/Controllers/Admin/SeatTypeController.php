<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeatTypeRequests;
use Illuminate\Support\Facades\Auth;

class SeatTypeController extends Controller
{
    private $seatType;
    public function __construct(SeatType $seatType,)
    {
        $this ->seatType = $seatType;
    }

    public function index()
    {
        $seatTypes=$this->seatType -> latest()->paginate(5) ;

        return view('Admin/seats/seat_type/list', compact('seatTypes'));
    }

    public function create()
    {
        // dd(Auth::user());
        return view('Admin/seats/seat_type/create');
    }

    public function store(SeatTypeRequests $request )
    {
       
        
            $data = 
            [
                'name' => $request->name,
                'price' => $request->price
            ];
            $this->seatType->create($data);
            return redirect()->route('admin.seat_type')->with('message','Thêm thành công!');
       
        
    }

    public function edit($id)
    {
       $seatType = $this->seatType->find($id);

       return view('Admin/seats/seat_type/edit', compact('seatType'));
    }

    public function update()
    {

    }

    public function delete($id)
    {

    }
}
