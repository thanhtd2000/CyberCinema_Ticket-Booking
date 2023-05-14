<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Actor;

class MovieController extends Controller
{
    public  $categories;
    public $director;
    public $actors;
    public function __construct()
    {
        $this->actors = Actor::all();
        $this->categories = Category::all();
        $this->director = Director::all();
    }
    public function index()
    {
        //
        return view('Admin.movie.list');
    }

    public function create()
    {
        $categories = $this->categories;
        $director = $this->director;
        $actors = $this->actors;
        return view('Admin.movie.create', compact('categories', 'director', 'actors'));
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
