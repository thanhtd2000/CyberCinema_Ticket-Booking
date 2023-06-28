<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{
    public $discounts;
    public function __construct(Discount $discounts)
    {
        $this->discounts = $discounts;
    }


    public function index()
    {
        $discounts = $this->discounts->latest()->paginate(5);
        return view('Admin.discounts.list', compact('discounts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $discounts =  $this->discounts->where('name', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('Admin.discounts.list', compact('discounts'));
    }


    public function create()
    {
        return view('Admin.discounts.create');
    }

    public function store(DiscountRequest $request)
    {
        $discount = new Discount();
        $discount->code = $request['code'];
        $discount->min_price = $request['min_price'];
        $discount->max_price = $request['max_price'];
        $discount->count = $request['count'];
        $discount->start_time = $request['start_time'];
        $discount->end_time = $request['end_time'];
        $discount->percent = $request['percent'];

        if ($discount->code !== $this->discounts->code) {
            $discount->save();
            return redirect()->route('admin.discount')->with('message', 'Thêm mới mã giảm giá thành công');
        }
        // dd($discount);
        return back()->with('errors', 'Mã giảm giá đã tồn tại');
    }

    public function edit($id)
    {
        $discount = Discount::find($id);
        // dd($discount);

        return view('Admin.discounts.edit', compact('discount'));
    }

    public function update(DiscountRequest $request, $id)
    {
        $discount = Discount::find($id);
        $discount->code = $request['code'];
        $discount->min_price = $request['min_price'];
        $discount->max_price = $request['max_price'];
        $discount->count = $request['count'];
        $discount->start_time = $request['start_time'];
        $discount->end_time = $request['end_time'];
        $discount->percent = $request['percent'];

        $discount->update();

        return redirect()->route('admin.discount')->with('message', 'Thêm mới mã giảm giá thành công');
    }

    public function delete($id)
    {
        Discount::find($id)->delete();
        return back()->with('message', 'Xóa thành công');
    }
}
