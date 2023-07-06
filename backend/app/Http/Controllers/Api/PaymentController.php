<?php

namespace App\Http\Controllers\Api;

use App\Models\Orders;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Models\OrderSchedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public $convert;
    public $transaction;
    public $order;
    public $orderSchedule;
    public function __construct(Transaction $transaction , Orders $order , OrderSchedule $orderSchedule)
    {
        $this->transaction = $transaction;
        $this->order = $order;
        $this->orderSchedule = $orderSchedule;
        $this->convert = new GlobalHelper();
    }

    public function createPayment(Request $request)
    {
        // $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        // $vnp_TmnCode = "CLTVD813"; //Mã website tại VNPAY 
        // $vnp_HashSecret = "PNDTFXWNOMRTCKBHOYNVSTUDXRNJGNGQ"; //Chuỗi bí mật
        //them order
        //update order_id ->order_chedule
        //

        $vnp_TxnRef = 'CB' . '-' . $this->convert->randString(15); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 

        $vnp_OrderInfo = 'thanh toan test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // $vnp_Inv_Email=$request->email;
        //Add Params of 2.0.1 Version
        // dd($vnp_TxnRef);
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
            "vnp_ReturnUrl" =>'http://127.0.0.1:8000/api/payment',
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
        ['message'=> 'Success',
        'status'=> 00,
        'data'=> $vnp_Url]
       );



        


    }
    public function insertPayment(Request $request)
     {
        dd($request->toArray());
        // $user = $request->user();
        if($request->vnp_TransactionStatus == 00){
            $dataTrans = [
                'transactions_code' => $request->vnp_TransactionNo,
                'bank_code' => $request->vnp_BankCode,
                'payment_code' => $request->vnp_CardType,
                'status' => $request->vnp_TransactionStatus,
                'amount' => $request->vnp_Amount,
              
            ];

            $trasaction = $this->transaction->create($dataTrans);
            
         
            return redirect()->to('http://127.0.0.1:8000/admin/login');
        }else{
            return response()->json([
                'message' => 'Thanh toán thất bại vui lòng kiểm tra lại!',
                'status'=> 500
            ]);
        }

     }
}
