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
        $products = Product::all();
        return view('product.index', compact('products'));
    }

 
    public function create()
    {
        $product = new Product; // برای اینکه اگر فرم در حالت ایجاد بود همه فیلدها رو نشون بده اگر در حالت ویرایش بود فیلد نام کاربری و ایمیل رو نشون نده.
        return view('product.form', compact('product')); // برای ایجاد و ویرایش فروشگاه
        // product در حالت create ای دی ندارد.
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|between:1,100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2000',
        ]);
        dd($request->all());
    }

 
   
    public function edit(Product $product)
    {
        return view('product.form', compact('product')); // برای ایجاد و ویرایش فروشگاه
    }


    public function update(Request $request, product $product)
    {
        //
    }


    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') ); // DELETED in fa.json
    }
}
