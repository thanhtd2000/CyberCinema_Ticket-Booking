<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::paginate(10);
        return view('Admin.categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $categories = Category::where('name', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return view('Admin.categories.index', compact('categories', 'keywords'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('create-category')) {
            return view('Admin.categories.create');
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
    public function store(CategoryRequest $request)
    {
        $newCategory = $request->toArray();
        Category::create($newCategory);
        return redirect('admin/category/index')->with('message', 'Thêm thành công');
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
        if (Gate::allows('edit-category')) {
            $category = Category::find($id);
            return view('Admin.categories.edit', compact('category'));
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
    public function update(CategoryRequest $request, $id)
    {
        $request = $request->except(['_token', '_method']);

        Category::where('id', $id)->update($request);
        return redirect('admin/category/index ')->with('message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('delete-category')) {
            Category::find($id)->delete();
            return redirect('admin/category/index')->with('message', 'Xóa thành công!');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
    }
}
