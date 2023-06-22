<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Helpers\FirebaseHelper;
use App\Http\Requests\ActorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class ActorController extends Controller
{
    public $firebaseHelper;
    public function __construct()
    {
        $this->firebaseHelper = new FirebaseHelper();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $actors = Actor::paginate(10);
        return view('Admin.actors.index', compact('actors'));
    }


    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $actors = Actor::where('name', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return view('admin.actors.index', compact('actors', 'keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('create-actor')){
            return view('Admin.actors.create');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorRequest $request)
    {
        $path = 'Actors/';
        $newActor = $request->toArray();
        $actors = Actor::where('name', $newActor['name'])->where('birthday', $newActor['birthday'])->get();

        if (!empty($actors->toArray())) {
            return back()->with('errors', 'Diễn viên đã có!');
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $newActor['image'] =  $this->firebaseHelper->uploadimageToFireBase($image, $path);
                Actor::create($newActor);
                return redirect('admin/actor/index')->with('message', 'Thêm Thành công');
            }
            return redirect('admin/actor/index')->with('message', 'Thiếu ảnh');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::allows('edit-actor')){
            $actor = Actor::find($id);
        return view('admin.actors.edit', compact('actor'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActorRequest $request, $id)
    {
        $path = 'Actors/';
        $actor = Actor::find($id);
        $newActor = $request->toArray();
        if ($request->hasFile('image')) {
            // $this->firebaseHelper->deleteImage($actor->image, $path);
            $image = $request->file('image');
            $newActor['image'] =  $this->firebaseHelper->uploadimageToFireBase($image, $path);
            $actor->update($newActor);
            return redirect('admin/actor/index')->with('message', 'Cập nhật thành công');
        }
        $actor->update($newActor);
        return redirect('admin/actor/index ')->with('message', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('delete-actor')){
            Actor::find($id)->delete();
            return redirect('admin/actor/index')->with('message', 'Xóa thành công!');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
       
    }
}
