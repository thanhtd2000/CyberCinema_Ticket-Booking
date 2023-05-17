<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('Admin.products.list', compact('products'));
    }

    public function create()
    {
        return view('Admin.products.create');
    }

    public function store(Request $request)
    {
        $formfields = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        Product::create($formfields);

        return redirect('admin/product')->with('message', 'Create Product successfully');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return view('Admin.products.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $formfields = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        Product::where('id', $id)->update($formfields);
        return redirect('admin/product')->with('message', 'Product updated successfully');
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect('admin/product')->with('message', 'Product deleted successfully');
    }
}
