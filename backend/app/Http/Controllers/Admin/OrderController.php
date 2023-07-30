<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
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
        $keyname = $request->input('keyname');
        $keydate = $request->input('keydate');
        $keystatus = $request->input('keystatus');
        if ($keyname && $keydate && $keystatus) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%$keyname%")
                ->where('orders.created_at', 'LIKE', "%$keydate%")
                ->where('orders.status', '=', $keystatus)
                ->select('orders.*')->latest()
                ->paginate(20);
            return view("Admin.orders.list", compact('orders', 'keyname', 'keydate', 'keystatus'));
        } elseif ($keyname && $keydate) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%$keyname%")
                ->where('orders.created_at', 'LIKE', "%$keydate%")
                ->select('orders.*')->latest()
                ->paginate(20);
            return view("Admin.orders.list", compact('orders', 'keyname', 'keydate'));
        } elseif ($keyname && $keystatus) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%$keyname%")
                // ->where('orders.created_at', 'LIKE' , "%$keydate%")
                ->where('orders.status', '=', $keystatus)
                ->select('orders.*')->latest()
                ->paginate(20);
            return view("Admin.orders.list", compact('orders', 'keyname', 'keystatus'));
        } elseif ($keydate && $keystatus) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%$keyname%")
                // ->where('orders.created_at', 'LIKE' , "%$keydate%")
                ->where('orders.status', '=', $keystatus)
                ->select('orders.*')->latest()
                ->paginate(50);
            return view("Admin.orders.list", compact('orders', 'keydate', 'keystatus'));
        } elseif ($keyname) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%$keyname%")
                // ->where('orders.created_at', 'LIKE' , "%$keydate%")
                // ->where('orders.status', '=' , $keystatus)
                ->select('orders.*')->latest()
                ->paginate(50);
            return view("Admin.orders.list", compact('orders', 'keyname'));
        } elseif ($keydate) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                // ->where('users.name', 'LIKE' , "%$keyname%")
                ->where('orders.created_at', 'LIKE', "%$keydate%")
                // ->where('orders.status', '=' , $keystatus)
                ->select('orders.*')->latest()
                ->paginate(50);
            return view("Admin.orders.list", compact('orders', 'keydate'));
        } elseif ($keystatus) {
            $orders = $this->orders
                ->join('users', 'orders.user_id', '=', 'users.id')
                // ->where('users.name', 'LIKE' , "%$keyname%")
                // ->where('orders.created_at', 'LIKE' , "%$keydate%")
                ->where('orders.status', '=', $keystatus)
                ->select('orders.*')->latest()
                ->paginate(50);
            return view("Admin.orders.list", compact('orders', 'keystatus'));
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
            $user = User::find($orders->user_id);
            $backpoints = $user->points + $orders->points;
            $user->update(['points' =>  $backpoints]);
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

    public function showTicket($id)
    {
        
        $order = DB::table('orders')->find($id);
       
        $orderProducts = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('order_products.*', 'products.name')
            ->where('order_products.order_id', $order->id)
            ->where('order_products.status', '=', 2)
            ->get();
          
        $orderSchedules = DB::table('order_schedule')
            ->join('schedules', 'order_schedule.schedule_id', '=', 'schedules.id')

            ->join('movies', 'schedules.movie_id', '=', 'movies.id')
            ->join('rooms', 'schedules.room_id', '=', 'rooms.id')
            ->join('seats', 'order_schedule.seat_id', '=', 'seats.id')
            ->select('order_schedule.*', 'movies.name as movie_name', 'movies.time as movie_time', 'schedules.time_start', 'rooms.name as room_name', 'seats.name as seat_name')
            ->where('order_schedule.order_id', $order->id)
            ->get();
            
        $orderDiscounts = DB::table('orders')
            ->leftJoin('discounts', 'orders.discount_id', '=', 'discounts.id')
            ->select('orders.*', 'discounts.*')
            ->where('orders.order_code', '=', $order->order_code)
            ->first();
        $orderTransaction =  DB::table('orders')
            ->join('transactions', 'orders.transaction_id', '=', 'transactions.id')
            ->select('transactions.*')
            ->where('orders.order_code', '=', $order->order_code)
            ->first();
        $seatNames = $orderSchedules->pluck('seat_name')->toArray();
        $seatNames = implode(', ', $seatNames);
        $timeStart = $orderSchedules[0]->time_start;
        $timeStartParts = explode(" ", $timeStart);
        $datePart = $timeStartParts[0]; // Ngày (YYYY-MM-DD)
        $timePart = $timeStartParts[1]; // Thời gian (HH:ii:ss)
        $productNames = implode(', ', $orderProducts->pluck('name')->toArray());
         $data =[
            'movie_name' => $orderSchedules[0]->movie_name,
            'movie_time' =>$orderSchedules[0]->movie_time,
           
            'datePart' =>$datePart,
            'timePart' =>$timePart,
            'room_name' =>$orderSchedules[0]->room_name,
            'seatNames' =>$seatNames,
            'productNames' =>  $productNames,
            'total' => $order->total,
            'discount' =>  $orderDiscounts->code,
            'status_ticket' =>$order->status_ticket,
            'status' =>$order->status

         ];
        return response()->json($data);
    }
}
