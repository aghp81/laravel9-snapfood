<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;

class LandingController extends Controller
{
    // برای لود شدن صفحات مختلف
    public function loadPage($page)
    {
        if(method_exists($this, $page))
        {
            return $this->$page();
        }else{
            abort(404);
        }
    }

    public function products()
    {
        // نمایش محصولات در صفحه landing
        $products = Product::paginate(9);
        return view('landing.products', compact('products'));
    }

    public function shops()
    {
        return view('landing.shops');
    }

}
