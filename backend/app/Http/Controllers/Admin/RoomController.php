<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Schedule;
use App\Models\SeatType;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Http\Requests\RoomRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    public $room;
    public $seat;
    public $seatType;
    public $schedule;

    public function __construct(Room $room, Seat $seat, SeatType $seatType, Schedule $schedule)
    {
        $this->room = $room;
        $this->seat = $seat;
        $this->seatType = $seatType;
        $this->schedule = $schedule;
    }

    public function index()
    {
        $rooms = $this->room->paginate(5);
        $currentDateTime = Carbon::now();
        $schedule = $this->schedule->get();
        $endDate = Carbon::create(2023, 6, 16, 23, 59, 59);

        return view('Admin/Room/list', compact('rooms', 'schedule', 'currentDateTime', 'endDate'));
    }
    
    public function create()
    {
        if(Gate::allows('create-room')){
        
            $seatTypes = $this->seatType->get();

            return view('Admin/Room/create', compact('seatTypes'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
        
    }
    public function store(RoomRequest $roomRequest)
    {
        $data =
            [
                'name' => $roomRequest->name,
                'row' => $roomRequest->row,
                'column' => $roomRequest->column
            ];

        $room = $this->room->create($data);
        $alphabet = range('A', 'Z');
        $num_of_elements = $room->row;
        $elements = array_slice($alphabet, 0, $num_of_elements);
        foreach ($elements as $element) {
            for ($i = 1; $i <= $room->column; $i++) {
                $dataSeat = [
                    'name' => $element . $i,
                    'type_id' => 2,
                    'room_id' => $room->id,
                    'status' => 0,
                ];
                $this->seat->create($dataSeat);
            }
        }
        return redirect()->route('admin.room')->with('success', 'Thêm thành công!');
    }

    public function edit($id)
    {
        if(Gate::allows('create-room')){
            $seatType = $this->seatType->get();
            $seats = $this->seat->where('room_id', $id)->get();
            $room = $this->room->find($id);
            $alphabet = range('A', 'Z');
            $num_of_elements = $room->row;
            $elements = array_slice($alphabet, 0, $num_of_elements);
            $currentDateTime = Carbon::now();
            $schedule = $this->schedule->where('room_id', $id)->where('time_start', '<=', $currentDateTime)->where('time_end', '>=', $currentDateTime)->get();
            if (!empty($schedule->toArray())) {
                return back()->with('errors', 'Phòng đang chiếu phim không thể sửa!');
            } else {
                return view('Admin/Room/edit', compact('room', 'seatType', 'seats', 'elements'));
            }
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
       
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate(
                $request,
                [
                    'roomname' => 'required'
                ],
                [
                    'roomname.required' => 'Không được bỏ trông tên phòng!',
                ]
            );
            $data =
                [
                    'name' => $request->roomname,
                ];
            $this->room->find($id)->update($data);
            return redirect()->route('admin.room')->with('message', 'Sửa thành công!');
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('errors', 'Phòng đã tồn tại');
            } else {
                return redirect()->back()->with('errors', 'Lỗi');
            }
        }
    }

    public function destroy(Request $request)
    {
        if(Gate::allows('delete-room')){
        if ($request->type == 2) {
            $this->room->withTrashed()->find($request->id)->forceDelete();
            return redirect()->back()->with('message', 'Xoá Vĩnh Viễn Thành Công!');
        }
        $currentDateTime = Carbon::now();
        $schedule = $this->schedule->where('room_id', $request->id)->where('time_start', '<=', $currentDateTime)->where('time_end', '>=', $currentDateTime)->get();

        if (!empty($schedule->toArray())) {
            return back()->with('errors', 'Phòng đang chiếu phim không thể xóa!');
        } else {
            $this->room->find($request->id)->delete();
            return redirect()->back()->with('message', 'Đã chuyển vào thùng rác!');
        }
    } else {
        return back()->with('errors', 'Bạn không có quyền');
    }
    }
    public function trash()
    {
        if(Gate::allows('create-room')){
            $rooms = $this->room->onlyTrashed()->latest()->paginate(10);;
            return view('Admin.room.trash', compact('rooms'));
            
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }
    public function restore(Request $request)
    {
        $room =  $this->room->withTrashed()->find($request->id);
        $room->restore();
        return redirect()->route('admin.room.trash');
    }
}
