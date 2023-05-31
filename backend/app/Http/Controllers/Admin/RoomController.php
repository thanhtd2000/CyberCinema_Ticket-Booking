<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    public $room;
    public $seat;
    public $seatType;
 
    public function __construct(Room $room, Seat $seat , SeatType $seatType)
    {
        $this->room =$room;
        $this->seat =$seat;
        $this->seatType =$seatType;
 
    }

    public function index()
    {
        $rooms = $this->room->paginate(5);
        return view('Admin/Room/list',compact('rooms'));
    }

    public function create()
    {
       
        $seatTypes = $this->seatType->get();
       
        return view('Admin/Room/create',compact('seatTypes'));
    }
   public function store(RoomRequest $roomRequest){
        $data = 
        [
            'name' => $roomRequest->name,
            'row' => $roomRequest->row,
            'column' => $roomRequest->column
        ];
        $this->room->create($data);
        return redirect()->route('admin.room')->with('message','Thêm thành công!');
   }

   public function edit($id)
   {
        $seatType = $this->seatType->get();
        $seat = $this ->seat->get();
        $room = $this -> room ->find($id);
        $alphabet = range('A', 'Z');
        $num_of_elements = $room->row;
        $elements = array_slice($alphabet, 0, $num_of_elements);
        
        return view('Admin/Room/edit',compact('room','seatType','seat','elements'));
   }
}
