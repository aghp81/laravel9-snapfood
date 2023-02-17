<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Cart;

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

    // نمایش اطلاعات فروشگاه در صفحه هر فروشگاه
    public function showShop(Shop $shop)
    {
        $products = Product:: where('shop_id', $shop->id)->paginate(9); // نمایش محصولات مربوط به هر فروشگاه در صفحه خودش
        // dd($shop);
        return view('landing.shop', compact('shop', 'products'));
    }

    public function products()
    {
        // جستجوی محصولات
        $products = Product::query();

        // جستجو بر اساس نام محصول
        if ($p = request('p')) {
            $products = $products->where('title', 'like', "%$p%");
        }

        // جستجو بر اساس مرتب سازی
        if ($o = request('o')) {
            if ($o == 1) {
                $products = $products->latest(); 
            }
            if ($o == 2) {
                $products = $products->orderBy('price', 'ASC'); 
            }
            if ($o == 3) {
                $products = $products->orderBy('price', 'DESC'); 
            }
        }


        // نمایش محصولات در صفحه landing
        $products = $products->paginate(9);
        return view('landing.products', compact('products'));
    }

    public function shops()
    {
        $shops = Shop::latest()->paginate(2);
        return view('landing.shops', compact('shops'));
    }

    // نمایش صفحه سبد خرید
    public function cart()
    {
        $user_id = auth()->id(); // باید ایتدا ببینیم کاربر لاگین کرده که بتوان سبد خرید او را بررسی کرد.

        $cart = Cart::where('user_id', $user_id)->where('finished', 0)->first(); //  اگر کاربری داشتیم کارت رو پیدا کنه و اونجایی که سبد خرید finished = 0 شده 
        // dd($cart);
        // dd($cart->items);
        return view('landing.cart', compact('cart'));
    }

}
