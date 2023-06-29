<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Orders;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use Google\Cloud\Storage\Connection\Rest;

class DiscountController extends Controller
{
    public function getDiscount(Request $request)
    {
        $dateNow = Carbon::now()->format('Y-m-d');

        $discount = Discount::where('code', $request->code)->where('start_time', '<=', $dateNow)->where('end_time', '>=', $dateNow)->first();
        if (empty($discount)) {
            return response()->json([
                'status_code' => 406,
                'message' => 'Mã này đã hết hạn hoặc không tồn tại!'
            ], 406);
        } else {
            $user = $request->user();
            $useDiscount = Orders::where('discount_id', $discount->id)->where('user_id', $user->id)->first();
            if (!empty($useDiscount)) {
                return response()->json([
                    'status_code' => 406,
                    'message' => 'Bạn đã sử dụng mã giảm giá này !'
                ], 406);
            } else {
                $data = new DiscountResource($discount);
                return response()->json($data, 200);
            }
        }
    }
}
