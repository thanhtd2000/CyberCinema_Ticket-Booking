<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{

    public $transaction;
    public $orders;
    public $orderProduct;
    public $orderSchedule;
    public $product;
    public function __construct(Transaction $transaction, Orders $orders, OrderSchedule $orderSchedule, OrderProducts $orderProduct, Product $product)
    {
        $this->transaction = $transaction;
        $this->orders = $orders;
        $this->orderSchedule = $orderSchedule;
        $this->orderProduct = $orderProduct;
        $this->product = $product;
    }

    public function index()
    {
        $orders = Orders::all();
        return view("Admin.orders.list", compact('orders'));
    }

    public function cancel($id)
    {
        if (Gate::allows('delete-room')) {
            $orders =  $this->orders->find($id);

        $orders->update([
            'status' => 3
        ]);

        $orderProduct = $this->orderProduct->where('order_id', $orders->id)->first();
        if ($orderProduct) {
            $orderProduct1 = $this->orderProduct->where('order_id', $orders->id)->update(['status' => 3]);

            $products = $this->product->find($orderProduct->product_id);
            $count = $products->count + $orderProduct->quantity;
            $products->update([
                'count' => $count
            ]);
        }
        $this->transaction->where('order_code', $orders->order_code)->update(['status' => 3]);

        $this->orderSchedule->where('order_id', $orders->id)->delete();

        return back()->with('message', 'Hủy thành công');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
        
    }
}