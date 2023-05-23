<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('Admin.areas.list', compact('areas'));
    }

    public function create()
    {
        return view('Admin.areas.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|max:225|unique:areas,name',
        ]);
        Area::create($formFields);
        return redirect('admin/area')->with('message', 'Thêm thành công');
    }

    public function edit($id)
    {
        $area = Area::find($id);
        return view('Admin.areas.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => 'required|max:225|unique:areas,name',
        ]);
        Area::where('id', $id)->update($formFields);
        return redirect('admin/area')->with('message', 'Sửa thành công!');
    }

    public function delete($id)
    {
        Area::find($id)->delete();
        return redirect('admin/area')->with('message', 'Xóa Thành công!');
    }
}
