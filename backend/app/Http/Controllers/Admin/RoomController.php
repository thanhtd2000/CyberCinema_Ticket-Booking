<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\SeatRow;
use App\Models\SeatType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $room;
    public $seatRow;
    public $seatType;
    public $cinema;
    public function __construct(Room $room, SeatRow $seatRow , SeatType $seatType, Cinema $cinema)
    {
        $this->room =$room;
        $this->seatRow =$seatRow;
        $this->seatType =$seatType;
        $this->cinema =$cinema;
    }

    public function index()
    {
        return view('Admin/Room/list');
    }

    public function create()
    {
        $cinemas = $this->cinema->get();
        $seatTypes = $this->seatType->get();
        $seatRows = $this->seatRow->get();
        return view('Admin/Room/create',compact('seatTypes','seatRows','cinemas'));
    }
}
