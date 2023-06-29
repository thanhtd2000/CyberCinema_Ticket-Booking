<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    
}
