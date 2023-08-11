<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class TicketController extends Controller
{
    public function check_ticket(Request $request)
    {
        $order =  Orders::where('order_code', $request->code)->first();
        if (isset($order) && $order->status_ticket != 2) {
            $order->update(['status_ticket' => 2]);
            return redirect()->to(route('bill', ['details' => Crypt::encrypt($request->code)]))->with('message', 'Xác nhận vé thành công');
        }
        return 'Vé đã được sử dụng hoặc không tồn tại';
    }
}
