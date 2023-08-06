<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function check_ticket(Request $request)
    {
        $order =  Orders::where('order_code', $request->code)->first();
        if (isset($order) && $order->status_ticket != 2) {
            $order->update(['status_ticket' => 2]);
            return 'Xác nhận vé thành công';
        }
        return 'Vé đã được sử dụng hoặc không tồn tại';
    }
}
