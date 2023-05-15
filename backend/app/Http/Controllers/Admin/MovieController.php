<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Director;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public  $categories;
    public $directors;
    public $actors;
    public function __construct()
    {
        $this->actors = Actor::all();
        $this->categories = Category::all();
        $this->directors = Director::all();
    }
    public function index()
    {
        $movies = Movie::latest()->paginate(10);;
        return view('Admin.movie.list', compact('movies'));
    }

    public function create()
    {
        $categories = $this->categories;
        $directors = $this->directors;
        $actors = $this->actors;
        return view('Admin.movie.create', compact('categories', 'directors', 'actors'));
    }


    public function store(MovieRequest $request)
    {

        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = Str::random(4) . $file->getClientOriginalName();
            $path = 'uploads/movies/';
            $file->move($path, $fileName);
            $mv['image'] = $path . $fileName;
            $mv['name'] = $request->name;
            $mv['description'] = $request->description;
            $mv['date'] = $request->date;
            $mv['director_id'] = $request->director_id;
            $mv['category_id'] = $request->category_id;
            $mv['trailer'] = $request->trailer;
            $mv['time'] = $request->time;
            $mv['language'] = $request->language;
            $mv['price'] = $request->price;
            $movie = Movie::create($mv);
        }
        foreach ($request->actors as $actor) {
            DB::table('actor_movies')->insert([
                [
                    'movie_id' =>  $movie->id,
                    'actor_id' => $actor,
                ]
            ]);
        }
        return redirect()->route('admin.movie')->with('message', 'Thêm thành công');
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
        Movie::find($id)->delete();
        DB::table('actor_movies')->where('movie_id', $id)->delete();
        return redirect()->route('admin.movie')->with('message', 'Xoá Thành Công!');
        //
    }
}
