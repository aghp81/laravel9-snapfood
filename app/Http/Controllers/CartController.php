<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // dd($product);
        // dd(auth()->user()); // آیا کاربری که دکمه افزودن به سبد خرید را زده لاگین کرده یا نه؟
        
        $currentLogedInUser = auth()->user();
        
        // اگر کاربر لاگین کرده بود.
        if ($currentLogedInUser) {
            dd('ok');
        }else{
            return back()->withError('لطفا ابتدا وارد حساب کاربری خود شوید.'); // اگر کاربر لاگین نکرده بود.
        }
    
    }
}
