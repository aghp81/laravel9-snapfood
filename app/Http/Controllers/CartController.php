<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // dd($product);
        // dd(auth()->user()); // آیا کاربری که دکمه افزودن به سبد خرید را زده لاگین کرده یا نه؟
        
        $currentLogedInUser = auth()->user();
        
        // اگر کاربر لاگین کرده بود.
        if ($currentLogedInUser) {
            // dd('ok');

            // چک کنیم که آیا قبلا برای کاربری سبد خرید ایجاد شده است؟
            $cart = Cart::where('user_id', $currentLogedInUser->id)->first();
            // dd($cart);
            
            // اگر کارت برای کاربر جاری ایجاد نشده بود.
            if (!$cart) {
                $cart = Cart::create(['user_id' => $currentLogedInUser->id]);
            }
            dd($cart);
        }else{
            return back()->withError('لطفا ابتدا وارد حساب کاربری خود شوید.'); // اگر کاربر لاگین نکرده بود.
        }
    
    }
}
