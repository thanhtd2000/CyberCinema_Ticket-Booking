<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieDetailResource;

class MovieController extends Controller
{
    public $movies;
    public function __construct(Movie $movie)
    {
        $this->movies = $movie;
    }


    public function index(Request $request)
    {
        $slug = $request->input('slug');
        if (!$slug) {
            $isHot = $request->input('isHot');
            $orderBy = $request->input('orderBy', 'name');
            $limit = $request->input('limit', 8);
            $order = $request->input('order', 'DESC');
            $s = $request->input('s');

            $query = $this->movies->limit($limit)->orderBy($orderBy, $order);
            if ($s !== null) {

                $movie = $this->movies->search($s)->orderBy($orderBy, $order)->paginate($limit);
                $data = new MovieCollection($movie);
                return response()->json($data, 200);
            }
            if ($isHot !== null) {
                $query->where('isHot', $isHot);
            }
            $movie = $query->paginate($limit);
            $data = new MovieCollection($movie);
            return response()->json($data, 200);
        } else {
            $movie = $this->movies->where('slug', $slug)->get();
            if ($this->movies->where('slug', $request->slug)->exists()) {
                $data = MovieDetailResource::collection($movie);
                return response()->json($data, 200);
            } else {
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Không tìm thấy thông tin'
                ], 404);
            }
        }
    }
    public function detail(Request $request)
    {
        $movie = $this->movies->where('slug', $request->slug)->get();
        if ($this->movies->where('slug', $request->slug)->exists()) {
            $data = MovieDetailResource::collection($movie);
            return response()->json($data, 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Không tìm thấy thông tin'
            ], 404);
        }
    }
}
