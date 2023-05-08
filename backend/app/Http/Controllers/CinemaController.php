<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cinema;
use Illuminate\Http\Request;

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
        $formFields = $request->validate([
            'name' => 'required',
            'area_id' => 'required',
            'address' => 'required',
        ]);

        Cinema::create($formFields);

        return redirect('admin/cinema')->with('message', 'Create successfully');
    }

    public function edit($id) {
        $areas = Area::all();
        $cinemas = Cinema::find($id);
        
        return view('Admin.cinemas.edit', compact('cinemas', 'areas'));
    }

    public function update(Request $request, $id) {
        $formFields = $request->validate([
            'name' => 'required',
            'area_id' => 'required',
            'address' => 'required',
        ]);

        Cinema::where('id', $id)->update($formFields);
        return redirect('admin/cinema')->with('message', 'Update successfully');
    }
 
    public function delete($id) {
        Cinema::where('id', $id)->delete();
        return redirect('admin/cinema')->with('message', 'Delete successfully');
    }

}
