<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // برای پیاده سازی میدلور CheckAdmins
    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }
 
    public function index()
    {
        $products = product::all();
        return view('product.index', compact('products'));
    }

 
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

 
   
    public function edit(product $product)
    {
        //
    }


    public function update(Request $request, product $product)
    {
        //
    }


    public function destroy(product $product)
    {
        //
    }
}
