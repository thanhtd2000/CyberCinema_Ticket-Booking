<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Orders;
use App\Models\Product;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public $convert;
    public $transaction;
    public $order;
    public $orderSchedule;
    public $orderProduct;
    public $product;
    public function __construct(Transaction $transaction, Orders $order, OrderSchedule $orderSchedule, OrderProducts $orderProduct, Product $product)
    {
        $this->transaction = $transaction;
        $this->order = $order;
        $this->orderSchedule = $orderSchedule;
        $this->orderProduct = $orderProduct;
        $this->product = $product;
        $this->convert = new GlobalHelper();
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function createPayment(Request $request)
    {
        $user = $request->user();
        if ($request->points > $user->points) {
            return response()->json(
                [
                    'message' => 'Điểm của khách không đủ !!!',
                    'status_code' => 404
                ],
                404
            );
        }
        $usedpoints = $user->points - $request->points;
        User::find($user->id)->update(['points' =>  $usedpoints]);
        // dd($request->all());
        if ($request->typePayment == 'VNPay') {
            $user = $request->user();
            $vnp_TxnRef = 'CB' . '-' . $this->convert->randString(15); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
            $vnp_OrderInfo = 'thanh toan test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = '';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            if ($request->discount_id == 0) {
                $order = $this->order->create([
                    'total' => $request->total,
                    'user_id' => $user->id,
                    'order_code' => $vnp_TxnRef,
                    'points' => $request->points,
                    'status' => 1
                ]);
            } else {
                $order = $this->order->create([
                    'total' => $request->total,
                    'user_id' => $user->id,
                    'discount_id' => $request->discount_id,
                    'order_code' => $vnp_TxnRef,
                    'points' => $request->points,
                    'status' => 1
                ]);
            }

            // $orderSchedules = $this->orderSchedule->where('schedule_id',$request->schedule_id)->where('user_id',$user->id)->where('seat_id')->update();

            foreach ($request->seat_id as $seatId) {

                $orderSchedule = $this->orderSchedule->where('schedule_id', $request->schedule_id)->where('user_id', $user->id)->where('seat_id', $seatId)->update(['order_id' => $order->id]);
            }

            foreach ($request->product as $product) {
                if ($product['amount'] != 0) {
                    $this->orderProduct->create([
                        'quantity' => $product['amount'],
                        'product_id' => $product['id'],
                        'order_id' => $order->id,
                        'status' => 0
                    ]);
                }
            }
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => env('VNP_TMN_CODE'),
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => 'http://127.0.0.1:8000/api/payment',
                "vnp_TxnRef" => $vnp_TxnRef,
                // "vnp_Inv_Email"=>$vnp_Inv_Email,

            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = env('VNP_URL') . "?" . $query;
            if (env('VNP_HASH_SECRET')) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET')); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            // dd($vnp_Url);
            return response()->json(
                [
                    'message' => 'Success',
                    'status' => 00,
                    'data' => $vnp_Url
                ]
            );
        } elseif ($request->typePayment == 'ONEPay') {

          
            $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
            $vpcURL ='https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";
            // unset($_POST["virtualPaymentClientURL"]); 
            // unset($_POST["SubButL"]);
            $vpcMerchant = 'ONEPAY';
            $vpcAccessCode = 'D67342C2';
            $vpcMerchTxnRef = 'CB' ;
            $vpcOrderInfo = 'JSECURETEST01';
            $vpcAmount = 10000 ;
            $vpcReturnURL = 'http://127.0.0.1:8000/api/payment';
            $vpcVersion = '2';
            $vpcCommand = 'pay';
            $vpcLocale = 'vn';
            $vpcCurrency = 'VND';

            
            $data = array(
                "vpc_Merchant" => $vpcMerchant,
                "vpc_AccessCode" => $vpcAccessCode,
                "vpc_MerchTxnRef" => $vpcMerchTxnRef,
                "vpc_OrderInfo" => $vpcOrderInfo,
                "vpc_Amount" => $vpcAmount,
                "vpc_ReturnURL" => $vpcReturnURL,
                "vpc_Version" => $vpcVersion,
                "vpc_Command" => $vpcCommand,
                "vpc_Locale" => $vpcLocale,
                "vpc_Currency" => $vpcCurrency,
            );
                

            
            $stringHashData = "";
            ksort ($data);
            $appendAmp = 0;
            
            foreach($data as $key => $value) {
                if (strlen($value) > 0) {
                    if ($appendAmp == 0) {
                        $vpcURL .= urlencode($key) . '=' . urlencode($value);
                        $appendAmp = 1;
                    } else {
                        $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                    }
                    if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                        $stringHashData .= $key . "=" . $value . "&";
                    }
                }
            }
           
            $stringHashData = rtrim($stringHashData, "&");
            if (strlen($SECURE_SECRET) > 0) {
                $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
            }
           
            return response()->json(
                [
                    'message' => 'Success',
                    'status' => 00,
                    'data' => $vpcURL
                ]
            );
            

        }
    }


    public function insertPayment(Request $request)
    {
        // dd($request->toArray());
        // $user = $request->user();
        if ($request->vnp_TransactionStatus == 00) {
            $dataTrans = [
                'transactions_code' => $request->vnp_TransactionNo,
                'bank_code' => $request->vnp_BankCode,
                'payment_code' => $request->vnp_CardType,
                'status' => 2,
                'amount' => $request->vnp_Amount,
                'order_code' => $request->vnp_TxnRef,
            ];

            $transaction = $this->transaction->create($dataTrans);

            $this->order->where('order_code', $transaction->order_code)->update([
                'transaction_id' => $transaction->id,
                'status' => 2
            ]);

            $order = $this->order->where('order_code', $transaction->order_code)->first();
            $this->orderProduct->where('order_id', $order->id)->update(['status' => 2]);
            $this->orderSchedule->where('order_id', $order->id)->update(['status' => 2]);
            $points = ceil($order->total / 10000);
            User::find($order->user_id)->update(['points' => $points]);
            $orderProduct = $this->orderProduct->where('order_id', $order->id)->first();
            if ($orderProduct) {
                $products = $this->product->find($orderProduct->product_id);
                $count = $products->count - $orderProduct->quantity;;

                $products->update([
                    'count' => $count
                ]);
            }
            $order_code  = $dataTrans['order_code'];
            return redirect()->to(route('bill', ['details' => Crypt::encrypt($order_code)]));
        } else {
            $dataTrans = [
                'transactions_code' => $request->vnp_TransactionNo,
                'bank_code' => $request->vnp_BankCode,
                'payment_code' => $request->vnp_CardType,
                'status' => 3,
                'amount' => $request->vnp_Amount,
                'order_code' => $request->vnp_TxnRef,
            ];
            $transaction = $this->transaction->create($dataTrans);
            $this->order->where('order_code', $transaction->order_code)->update([
                'transaction_id' => $transaction->id,
                'status' => 3
            ]);
            $orders = $this->order->where('order_code', $transaction->order_code)->first();
            $user = User::find($orders->user_id);
            $backpoints = $user->points + $orders->points;
            $user->update(['points' =>  $backpoints]);
            $this->orderSchedule->where('order_id', $orders->id)->delete();
            // $orderProduct = $this->orderProduct->where('order_id',$order->id)->update(['status' => 1]);
            return redirect()->to('http://localhost:3200/payment/failed');
        }
    }
}
