<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeatRow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeatRowRequest;

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

   public function create()
   {
      return view('Admin/seats/seat_row/create');
   }

   public function store(SeatRowRequest $seatRowRequest)
   {
      $data = [
         'name'=>$seatRowRequest->name
      ];
      $this->seatRow -> create($data);
      return redirect()->route('admin.seat_row')->with('message','Thêm thành công!');

   }

   public function edit($id)
   {
      
   }

}
