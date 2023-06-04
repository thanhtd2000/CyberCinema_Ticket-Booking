<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;

class Postcontroller extends Controller
{
    public $posts;
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }
    public function index()
    {
        $posts = Post::latest()->paginate();
        $data = new PostCollection($posts);
        return response()->json($data, 200);
    }
    public function detail(Request $request)
    {
        $movie = $this->posts->where('slug', $request->slug)->get();
        if ($this->posts->where('slug', $request->slug)->exists()) {
            $data = PostResource::collection($movie);
            return response()->json($data, 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Item Not Found'
            ], 404);
        }
    }
}
