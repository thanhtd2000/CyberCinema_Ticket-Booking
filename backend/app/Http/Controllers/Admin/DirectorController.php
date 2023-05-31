<?php

namespace App\Http\Controllers\Admin;

use App\Models\Director;
use Illuminate\Http\Request;
use App\Helpers\FirebaseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DirectorRequest;

class DirectorController extends Controller
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
        $directors = Director::paginate(10);
        return view('Admin.directors.index', compact('directors'));
    }


    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $directors = Director::where('name', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return view('admin.directors.index', compact('directors','keywords'));
    }    
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.directors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorRequest $request)
    {
        $path = 'Directors/';
        $newDirecrtor = $request->toArray();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $newDirecrtor['image'] = $this->firebaseHelper->uploadimageToFireBase($image,$path);
            Director::create($newDirecrtor);
            return redirect('admin/actor/index')->with('message', 'Thêm Thành công');
            
        }   
        return redirect('admin/director/index')->with('message', 'Thiếu ảnh');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $director = Director::find($id);
        return view('admin.directors.edit', compact('director'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DirectorRequest $request, $id)
    {
        $path = 'Directors/';
        $director = Director::find($id);
        $newDirector = $request->toArray();
        if ($request->hasFile('image')){
            // $this->firebaseHelper->deleteImage($actor->image, $path);
            $image = $request->file('image');
            $newDirecrtor['image']= $this->firebaseHelper->uploadimageToFireBase($image,$path);
            $director->update($newDirecrtor);
            return redirect('admin/director/index')->with('message','Cập nhật thành công');
        }
        $director->update($newDirector);
        return redirect('admin/director/index')->with('message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Director::find($id)->delete();
        return redirect('admin/director/index')->with('message', 'Xóa thành công!');
    }
}