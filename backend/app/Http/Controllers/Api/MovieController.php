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

    public function index()
    {
        $movies = Movie::latest()->paginate(2);
        $data = new MovieCollection($movies);
        return response()->json($data, 200);
    }
    public function detail(Request $request)
    {
        $movie = $this->movies->where('slug', $request->slug)->get();
        if ($this->movies->where('slug', $request->slug)->exists()) {
            $data = MovieDetailResource::collection($movie);
            return response()->json([
                'status_code' => 200,
                'data' => $data,
                'message' => 'Get Information Successfully'
            ], 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Item Not Found'
            ], 404);
        }
    }
    public function create(Request $request)
    {
        $page = $request->input('page', 5);
        $isHot = $request->input('isHot');
        $limit = $request->input('limit', 10);
        $order = $request->input('order', 'DESC');
        $s = $request->input('s');

        $query = $this->movies->limit($limit)->orderBy('name', $order);

        if ($s !== null) {
            $query->where('name', 'like', '%' . $s . '%');
        }

        if ($isHot !== null) {
            $query->where('isHot', $isHot);
        }

        $movie = $query->paginate($page);
        $data = new MovieCollection($movie);

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        //
    }

    public function search(Request $request)
    {
        $movie = $this->movies->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        if ($this->movies->where('name', 'like', '%' . $request->search . '%')->exists()) {
            return response()->json($movie, 200);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'Item Not Found'
            ], 404);
        }
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
