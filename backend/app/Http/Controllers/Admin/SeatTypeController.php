<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SeatTypeRequests;

class SeatTypeController extends Controller
{
    private $seatType;
    public function __construct(SeatType $seatType,)
    {
        $this->seatType = $seatType;
    }

    public function index()
    {
        $seatTypes = $this->seatType->latest()->paginate(5);

        return view('admin/seats/seat_type/list', compact('seatTypes'));
    }

    public function create()
    {
        // dd(Auth::user());
        if (Gate::allows('create-seatType')) {
            return view('admin/seats/seat_type/create');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }

    public function store(SeatTypeRequests $request)
    {


        $data =
            [
                'name' => $request->name,
                'price' => $request->price
            ];
        $this->seatType->create($data);

        return redirect()->route('Admin.seat_type')->with('message', 'Thêm thành công!');
    }

    public function edit($id)
    {
        if (Gate::allows('edit-seatType')) {
            $seatType = $this->seatType->find($id);

            return view('admin/seats/seat_type/edit', compact('seatType'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }

    public function update($id, SeatTypeRequests $request)
    {
        $data =
            [
                'name' => $request->name,
                'price' => $request->price
            ];
        $this->seatType->find($id)->update($data);
        return redirect()->route('Admin.seat_type')->with('message', 'Sửa thành công!');
    }

    public function destroy($id)
    {
        if (Gate::allows('delete-seatType')) {
            $this->seatType->find($id)->delete($id);
            return redirect()->route('Admin.seat_type')->with('message', 'Delete thành công!');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }
}
