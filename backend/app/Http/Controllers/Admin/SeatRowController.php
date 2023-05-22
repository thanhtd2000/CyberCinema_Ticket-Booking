<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeatRow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeatRowController extends Controller
{
   private $seatRow;
   public function __construct(SeatRow $seatRow)
   {
      $this->seatRow = $seatRow;
   }

   public function index()
   {
    $seatRows=$this->seatRow -> latest()->paginate(5) ;

    return view('Admin/seats/seat_row/list', compact('seatRows'));
   }

}
