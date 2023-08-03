<?php

namespace App\Http\Controllers\Api;

use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validated();
        Contacts::create($data);
        return response()->json('success', 200);
    }
}
