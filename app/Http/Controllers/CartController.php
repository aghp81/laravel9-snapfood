<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function manage(Product $product, Request $request)
    {
        // dd($request->type);
        $type = $request->type; // add - minus
        // dd($product);
        // dd(auth()->user()); // آیا کاربری که دکمه افزودن به سبد خرید را زده لاگین کرده یا نه؟
        
        $currentLogedInUser = auth()->user();
        
        // اگر کاربر لاگین کرده بود.
        if ($currentLogedInUser) {
            // dd('ok');

            // چک کنیم که آیا قبلا برای کاربری سبد خرید ایجاد شده است؟
            // $cart = Cart::where('user_id', $currentLogedInUser->id)->first();
            // // dd($cart);
            
            // // اگر کارت برای کاربر جاری ایجاد نشده بود.
            // if (!$cart) {
            //     $cart = Cart::create(['user_id' => $currentLogedInUser->id]);
            // }
            // dd($cart);

            // متد firstOrCreate
            $cart = Cart::firstOrCreate(['user_id' => $currentLogedInUser->id]); // اگر در دیتابیس قبلا چیزی ثبت شده که شده اگر نه ایجاد کن.
            // dd($cart);
            
            // قبل از ثبت محصول در سبد خرید چک کنیم که آیا از قبل وجود دارد و اگر وجو دارد به تعداد آن افزوده شود.
            if ($cart_item = $product->isInCart()) { // اگز کارت آیتم برگردونه کارت آیتم باید کونتش ویرایش بشه
                
                if ($type == 'add') {
                    $cart_item->count++; // یه دونه به مقدارش اضافه بشه.
                }else{
                    $cart_item->count--;
                }
                
                $cart_item->payable = $cart_item->count * $product->cost; // تعداد محصول ضربدر قیمت نهایی = قیمت قابل پرداخت
                $cart_item->save();
            }else{ // اگر محصول در کارت نیست ایجاد شود.
                // ایجاد CartItem
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'count' => 1,
                    'payable' => $product->cost, // قیمت محصول پس از محاسبه تخفیف
                ]);
            }
            
            return back()->withMessage('آیتم موردنظر به سبد خرید اضافه شد.');

        }else{
            return back()->withError('لطفا ابتدا وارد حساب کاربری خود شوید.'); // اگر کاربر لاگین نکرده بود.
        }
    
    }

    // حذف از سبد خرید  
    public function remove(CartItem $cart_item)
    {
        dd($cart_item);
    }

}
