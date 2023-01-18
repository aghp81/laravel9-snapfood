<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        dd($product);
    }
}
