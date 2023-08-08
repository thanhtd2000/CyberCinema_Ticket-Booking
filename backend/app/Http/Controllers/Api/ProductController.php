<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public $products;
    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = Product::where('status',0)->latest()->paginate();
        $data = new ProductCollection($products);
        return response()->json($data);
    }
}
