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

        $room= $this->room->create($data);
        $alphabet = range('A', 'Z');
        $num_of_elements = $room->row;
        $elements = array_slice($alphabet, 0, $num_of_elements);
        foreach($elements as $element){
           for($i=1 ;$i <= $room->column;$i++){
            $dataSeat = [
                'name' => $element.$i,
                'type_id'=> 2 ,
                'room_id'=> $room->id
            ];
            $this->seat->create($dataSeat);
           }
        }
        return redirect()->route('admin.room')->with('message','Thêm thành công!');
   }

   public function edit($id)
   {
        $seatType = $this->seatType->get();
        $seats = $this ->seat->where('room_id', $id)->get();
        $room = $this -> room ->find($id);
        $alphabet = range('A', 'Z');
        $num_of_elements = $room->row;
        $elements = array_slice($alphabet, 0, $num_of_elements);
        
        return view('Admin/Room/edit',compact('room','seatType','seats','elements'));
   }
   public function update(RoomRequest $roomRequest, $id)
   {
    $data = 
    [
        'name' => $roomRequest->name,
        
    ];
    $this->room->find($id)->update($data);
    return redirect()->route('admin.room')->with('message','Sửa thành công!');

   }

   public function deleteSoft($id)
   {
    
   }
}
