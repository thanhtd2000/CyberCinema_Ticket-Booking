<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DateInterval;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Director;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    public  $categories;
    public $directors;
    public $actors;
    public $data;
    public function __construct()
    {
        $this->actors = Actor::all();
        $this->categories = Category::all();
        $this->directors = Director::all();
        $this->data = [
            'actors' =>  $this->actors,
            'categories' => $this->categories,
            'directors' =>   $this->directors,
        ];
    }
    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = 2;

        while (Movie::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
    public function index()
    {
        $movies = Movie::latest()->paginate(10);;
        return view('Admin.movie.list', compact('movies'))->with($this->data);
    }

    public function create()
    {
        return view('Admin.movie.create')->with($this->data);
    }


    public function store(MovieRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $student = app('firebase.firestore')->database()->collection('Images')->newDocument();
            $firebase_storage_path = 'Movies/';
            $name = $student->id();
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = $name . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                unlink($localfolder . $file);
            }
            $time = new DateTime('tomorrow');
            $expiresAt = $time->add(new DateInterval('P3Y'));
            $movieData['image'] =  app('firebase.storage')->getBucket()->object($firebase_storage_path . $file)->signedUrl($expiresAt);
            $movieData['name'] = $request->name;
            $movieData['description'] = $request->description;
            $movieData['date'] = $request->date;
            $movieData['director_id'] = $request->director_id;
            $movieData['category_id'] = $request->category_id;
            $movieData['trailer'] = $request->trailer;
            $movieData['time'] = $request->time;
            $movieData['language'] = $request->language;
            $movieData['price'] = $request->price;
            $slug = $this->generateUniqueSlug($request->name);
            $movieData['slug'] = $slug;
            if ($request->isHot == 'on') {
                $movieData['isHot'] = 0;
            };
            $movie = Movie::create($movieData);
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
    public function edit(Request $request)
    {
        $movie = Movie::find($request->id);
        return view('Admin.movie.edit', compact('movie'))->with($this->data);
    }


    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::find($id);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $student = app('firebase.firestore')->database()->collection('Images')->newDocument();
            $firebase_storage_path = 'Movies/';
            $name = $student->id();
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = $name . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                unlink($localfolder . $file);
            }
            $time = new DateTime();
            $expiresAt = $time->add(new DateInterval('P3Y'));
            $movie->image =  app('firebase.storage')->getBucket()->object($firebase_storage_path . $file)->signedUrl($expiresAt);
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
        if ($request->isHot == 'on') {
            $movie->isHot = 0;
        } else {
            $movie->isHot = 1;
        };
        $movie->save();
        $movie->actors()->sync($request->actors);
        return redirect()->route('admin.movie')->with('message', 'Sửa thành công');
    }

    public function destroy($id)
    {
        Movie::find($id)->delete();
        DB::table('actor_movies')->where('movie_id', $id)->delete();
        return redirect()->route('admin.movie')->with('message', 'Xoá Thành Công!');
        //
    }
}
