<?php

namespace App\Http\Controllers\Admin;


use PDOException;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\FirebaseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public  $categories;
    public $directors;
    public $actors;
    public $data;
    public  $firebaseHelper;
    public $movies;
    public $globalHelper;
    public function __construct(Movie $movies)
    {
        $this->actors = Actor::all();
        $this->categories = Category::all();
        $this->directors = Director::all();
        $this->data = [
            'actors' =>  $this->actors,
            'categories' => $this->categories,
            'directors' =>   $this->directors,
        ];
        $this->movies = $movies;
        $this->firebaseHelper = new FirebaseHelper();
        $this->globalHelper = new GlobalHelper();
    }


    public function index()
    {
        $movies = $this->movies->latest()->paginate(5);;
        return view('Admin.movie.list', compact('movies'))->with($this->data);
    }

    public function create()
    {
        return view('Admin.movie.create')->with($this->data);
    }

    public function store(MovieRequest $request)
    {
        try {
            $path = 'Movies/';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $movieData['image'] =  $this->firebaseHelper->uploadimageToFireBase($image, $path);
                $movieData['name'] = $request->name;
                $movieData['description'] = $request->description;
                $movieData['date'] = $request->date;
                $movieData['director_id'] = $request->director_id;
                $movieData['category_id'] = $request->category_id;
                $movieData['trailer'] = $request->trailer;
                $movieData['time'] = $request->time;
                $movieData['language'] = $request->language;
                $movieData['price'] = $request->price;
                $movieData['type'] = $request->type;
                $movieData['year_old'] = $request->year_old;
                $movieData['slug'] = $this->globalHelper->generateUniqueSlug($this->movies, $request->name);
                if ($request->isHot == 'on') {
                    $movieData['isHot'] = 0;
                };
                $movie = $this->movies->create($movieData);
            }
            if ($movie) {
                foreach ($request->actors as $actor) {
                    DB::table('actor_movies')->insert([
                        [
                            'movie_id' =>  $movie->id,
                            'actor_id' => $actor,
                        ]
                    ]);
                }
            }
            return redirect()->route('admin.movie')->with('message', 'Thêm thành công');
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Tên phim đã tồn tại');
            } else {
                return redirect()->back()->with('error', 'Lỗi');
            }
        }
    }
    public function edit(Request $request)
    {
        $movie = $this->movies->find($request->id);
        return view('Admin.movie.edit', compact('movie'))->with($this->data);
    }


    public function update(MovieRequest $request, $id)
    {
        try {

            $movie = $this->movies->find($id);

            $path = 'Movies/';
            if ($request->hasFile('image')) {
                $this->firebaseHelper->deleteImage($movie->image, $path);
                $image = $request->file('image');
                $movie->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
            }
            $movie->name = $request->name;
            $movie->description = $request->description;
            $movie->date = $request->date;
            $movie->director_id = $request->director_id;
            $movie->category_id = $request->category_id;
            $movie->trailer = $request->trailer;
            $movie->time = $request->time;
            $movie->language = $request->language;
            $movie->price = $request->price;
            $movie->type = $request->type;
            $movie->year_old = $request->year_old;
            if ($request->isHot == 'on') {
                $movie->isHot = 0;
            } else {
                $movie->isHot = 1;
            };
            $movie->slug = $this->globalHelper->generateUniqueSlug($this->movies, $request->name);
            $movie->save();
            $movie->actors()->sync($request->actors);
            return redirect()->route('admin.movie')->with('message', 'Sửa thành công');
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Tên phim đã tồn tại');
            } else {
                return redirect()->back()->with('error', 'Lỗi');
            }
        }
    }

    public function destroy(Request $request)
    {
        if ($request->type == 2) {
            $this->movies->withTrashed()->find($request->id)->forceDelete();
            return redirect()->back()->with('message', 'Xoá Vĩnh Viễn Thành Công!');
        }
        $this->movies->find($request->id)->delete();
        return redirect()->back()->with('message', 'Đã chuyển vào thùng rác!');
        //
    }
    public function trash()
    {
        $movies = $this->movies->onlyTrashed()->latest()->paginate(10);;
        return view('Admin.movie.trash', compact('movies'))->with($this->data);
    }


    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $movies = $this->movies->where('name', 'like', '%' . $request->input('keywords') . '%')
            ->paginate(5);
        return view('Admin.movie.list', compact('movies', 'keywords'))->with($this->data);
    }
    public function restore(Request $request)
    {
        $movie =  $this->movies->withTrashed()->find($request->id);
        $movie->restore();
        return redirect()->route('admin.movie.trash');
    }
    public function show($id)
    {
        $movie = $this->movies->withTrashed()->find($id);
        // Kiểm tra xem phim có tồn tại hay không
        if (!$movie) {
            abort(404);
        }
        return response()->json(['movie' => $movie]);
    }
}
