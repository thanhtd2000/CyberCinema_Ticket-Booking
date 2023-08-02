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
        $typePayment = $request->typePayment;

        switch ($typePayment) {
            case "VNPay":
                $vnp_TxnRef = 'CB' . '-' . $this->convert->randString(3) . time() . ""; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
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
                    "vnp_ReturnUrl" => BASE_URL . 'api/payment',
                    "vnp_TxnRef" => $vnp_TxnRef,

                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }
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
                $data = [

                    'message' => 'Success',
                    'status' => 00,
                    'data' => $vnp_Url
                ];
                break;
            case "Momo":
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán vé xem phim";
                $amount = $request->total;
                $orderId = 'CB' . '-' . $this->convert->randString(3) . time() . "";
                $redirectUrl = BASE_URL . 'api/payment';
                $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
                $extraData = "";

                if ($request->discount_id == 0) {
                    $order = $this->order->create([
                        'total' => $request->total,
                        'user_id' => $user->id,
                        'order_code' => $orderId,
                        'points' => $request->points,
                        'status' => 1
                    ]);
                } else {
                    $order = $this->order->create([
                        'total' => $request->total,
                        'user_id' => $user->id,
                        'discount_id' => $request->discount_id,
                        'order_code' => $orderId,
                        'points' => $request->points,
                        'status' => 1
                    ]);
                }

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
                $requestId = time() . "";
                $requestType = "captureWallet";
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = $this->convert->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);
                $data = [

                    'message' => 'Success',
                    'status' => 00,
                    'data' => $jsonResult['payUrl']
                ];
                break;
            default:
                $data = [
                    'message' => 'Lỗi!'
                ];
                break;
        }
        return response()->json($data);
    }
    public function insertPayment(Request $request)
    {
        // dd($request->all());
        if (isset($request->vnp_TransactionStatus)) {

            if ($request->vnp_TransactionStatus == 00) {
                $dataTrans = [
                    'transactions_code' => $request->vnp_TransactionNo,
                    'bank_code' => $request->vnp_BankCode,
                    'payment_code' => $request->vnp_CardType,
                    'status' => 2,
                    'amount' => $request->vnp_Amount / 100,
                    'order_code' => $request->vnp_TxnRef,
                ];

                $transaction = $this->transaction->create($dataTrans);

                $this->order->where('order_code', $transaction->order_code)->update([
                    'transaction_id' => $transaction->id,
                    'status' => 2, //trạng thái thanh toán thành công
                    'status_ticket' => 1, // trạng thái vé là chưa dùng
                ]);

                $order = $this->order->where('order_code', $transaction->order_code)->first();
                $this->orderProduct->where('order_id', $order->id)->update(['status' => 2]);
                $this->orderSchedule->where('order_id', $order->id)->update(['status' => 2]);
                $points = round($order->total / 10000);
                $user = User::find($order->user_id);
                $addpoints = $user->points + $points;
                $user->update(['points' =>  $addpoints]);
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
                    'amount' => $request->vnp_Amount / 100,
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
                return redirect()->to('http://localhost:3200/payment/failed');
            }
        }
        if (isset($request->resultCode)) {
            if ($request->resultCode == 0) {
                $dataTrans = [
                    'transactions_code' => $request->transId,

                    'payment_code' => 'Momo',
                    'status' => 2,
                    'amount' => $request->amount,
                    'order_code' => $request->orderId,
                ];

                $transaction = $this->transaction->create($dataTrans);

                $this->order->where('order_code', $transaction->order_code)->update([
                    'transaction_id' => $transaction->id,
                    'status' => 2,  //trạng thái thanh toán thành công
                    'status_ticket' => 1, // trạng thái vé là chưa dùng
                ]);

                $order = $this->order->where('order_code', $transaction->order_code)->first();
                $this->orderProduct->where('order_id', $order->id)->update(['status' => 2]);
                $this->orderSchedule->where('order_id', $order->id)->update(['status' => 2]);
                $points = round($order->total / 10000);
                $user = User::find($order->user_id);
                $addpoints = $user->points + $points;
                $user->update(['points' =>  $addpoints]);
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
                    'transactions_code' => $request->transId,

                    'payment_code' => 'Momo',
                    'status' => 3,
                    'amount' => $request->amount,
                    'order_code' => $request->orderId,
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
                return redirect()->to('http://localhost:3200/payment/failed');
            }
        }
    }
}
