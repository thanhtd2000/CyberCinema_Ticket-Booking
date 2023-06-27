<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\FirebaseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProducRequest;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public $products;
    public $firebaseHelper;
    public $globalHelper;
    public function __construct(Product $products)
    {
        $this->products = $products;
        $this->firebaseHelper = new FirebaseHelper();
        $this->globalHelper = new GlobalHelper();
    }

    public function index()
    {
        $products = $this->products->latest()->paginate(5);
        return view('admin.products.list', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $products =  $this->products->where('name', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.post.index', compact('products'));
    }

    public function create()
    {
        if(Gate::allows('create-product')){
            return view('Admin.products.create');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
        
    }

    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = 'Products/';
            $image = $request->image;
            $product = new Product();
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
        }
        $product->save();
        return redirect('admin/product')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit(Request $request)
    {
        if(Gate::allows('edit-product')){
            $product = $this->products->find($request->id);
        return view('Admin.products.edit', compact('product'));
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
        
    }

    public function update(ProductRequest $request)
    {
        $path = 'Products/';
        $product = $this->products::find($request->id);
        if ($request->hasFile('image')) {
            $this->firebaseHelper->deleteImage($product->image, $path);
            $image = $request->file('image');
            $product->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
        }
        $product->name = $request['name'];
        $product->price = $request['price'];
        // dd($product);
        $product->save();
        return redirect()->route('admin.product')->with('message', 'Sửa thành công');
    }

    public function delete($id)
    {
        if(Gate::allows('delete-product')){
            Product::where('id', $id)->delete();
            return redirect('admin/product')->with('message', 'Xóa sản phẩm thành công');
        } else {
            return back()->with('errors', 'Bạn không có quyền');
        }
       
    }
}
