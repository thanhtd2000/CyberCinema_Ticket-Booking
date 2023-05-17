<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    public $movies;
    public function __construct(Movie $movie)
    {
        $this->movies = $movie;
    }

    public function index()
    {
        $movies = $this->movies->latest()->paginate(10);
        $data = new MovieResource($movies);
        return response()->json($data, 200);
    }
    public function detail(Request $request)
    {
        $movie = $this->movies->where('slug', $request->slug)->get();
        if ($this->movies->where('slug', $request->slug)->exists()) {
            $data = MovieResource::collection($movie);
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
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
