<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use Illuminate\Support\Facades\DB;
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

    public function index(Request $request)
    {
        //  dd($request->input('keyname'));
        $keyname = $request -> input('keyname');
        $keydate = $request -> input('keydate');
        $keystatus = $request -> input('keystatus');
        if($keyname && $keydate && $keystatus){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE' , "%$keyname%")
            ->where('orders.created_at', 'LIKE' , "%$keydate%")
            ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(20);
            return view("Admin.orders.list", compact('orders','keyname','keydate','keystatus'));
        }elseif($keyname && $keydate){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE' , "%$keyname%")
            ->where('orders.created_at', 'LIKE' , "%$keydate%")
            ->select('orders.*')->latest()
            ->paginate(20);
            return view("Admin.orders.list", compact('orders','keyname','keydate'));
        }elseif($keyname && $keystatus){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE' , "%$keyname%")
            // ->where('orders.created_at', 'LIKE' , "%$keydate%")
            ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(20);
            return view("Admin.orders.list", compact('orders','keyname','keystatus'));

        }elseif($keydate && $keystatus){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE' , "%$keyname%")
            // ->where('orders.created_at', 'LIKE' , "%$keydate%")
            ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(50);
            return view("Admin.orders.list", compact('orders','keydate','keystatus'));
        }
        elseif($keyname){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE' , "%$keyname%")
            // ->where('orders.created_at', 'LIKE' , "%$keydate%")
            // ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(50);
            return view("Admin.orders.list", compact('orders','keyname'));
        }
        elseif($keydate){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            // ->where('users.name', 'LIKE' , "%$keyname%")
            ->where('orders.created_at', 'LIKE' , "%$keydate%")
            // ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(50);
            return view("Admin.orders.list", compact('orders','keydate'));
        }
        elseif($keystatus){
            $orders = $this->orders
            ->join('users', 'orders.user_id', '=', 'users.id')
            // ->where('users.name', 'LIKE' , "%$keyname%")
            // ->where('orders.created_at', 'LIKE' , "%$keydate%")
            ->where('orders.status', '=' , $keystatus)
            ->select('orders.*')->latest()
            ->paginate(50);
            return view("Admin.orders.list", compact('orders','keystatus'));
        }
        
        $orders = $this->orders->latest()->paginate(10);
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