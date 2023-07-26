<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;

class PointController extends Controller
{
    public function getpoints(Request $request)
    {
        $user = $request->user();
        return response()->json($user->points, 200);
    }
}
