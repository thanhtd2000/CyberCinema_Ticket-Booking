<?php

namespace App\Http\Controllers\Api;

use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request->content,
            'status' => 0
        ];
        Contacts::create($data);
        return response()->json([
            'message' => 'Gửi thông tin thành công',
            'status_code' => 200
        ], 200);
    }
}
