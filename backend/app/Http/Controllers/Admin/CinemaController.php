<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CinemaController extends Controller
{
    public function index() {
        $cinemas = Cinema::all();
        return view('Admin.cinemas.list', compact('cinemas'));
    }

    public function create() {
        $areas = Area::all();
        return view('Admin.cinemas.create', compact('areas'));
    }

    public function store(Request $request) {
        $areas = Area::all();
        
        $formFields = $request->validate([
            'name' => 'required',
            'area_id' => 'required',
            'address' => 'required',
        ]);

        Cinema::create($formFields);

        return redirect('admin/cinema')->with('message', 'Thêm thành công');
    }

    public function edit($id) {
        $areas = Area::all();
        $cinemas = Cinema::find($id);
        
        return view('Admin.cinemas.edit', compact('cinemas', 'areas'));
    }

    public function update(Request $request, $id) {
        $areas = Area::all();

        $formFields = $request->validate([
            'name' => 'required',
            'area_id' => 'required',
            'address' => 'required',
        ]);

        Cinema::where('id', $id)->update($formFields);
        return redirect('admin/cinema')->with('message', 'Sửa thành côngly');
    }
 
    public function delete($id) {
        Cinema::where('id', $id)->delete();
        return redirect('admin/cinema')->with('message', 'Xóa thành côngly');
    }

}
