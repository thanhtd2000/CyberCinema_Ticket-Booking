<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;

class Postcontroller extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate();
        $data = new PostCollection($posts);
        return response()->json([
            'message' => 'Get items successfully',
            'data' => $data,
            'status_code' => 200
        ], 200);
    }
}
