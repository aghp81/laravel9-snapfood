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
            $cart = Cart::firstOrCreate(['user_id' => $currentLogedInUser->id, 'finished' => 0]); // اگر در دیتابیس قبلا کارتی ثبت شده و هنوز بسته نشده بیار اگر نه ایجاد کن.
            // dd($cart);
            
            // قبل از ثبت محصول در سبد خرید چک کنیم که آیا از قبل وجود دارد و اگر وجو دارد به تعداد آن افزوده شود.
            if ($cart_item = $product->isInCart()) { // اگز کارت آیتم برگردونه کارت آیتم باید کونتش ویرایش بشه
                // اگر دکمه - را زدیم و مقدار محصول در کارت آیتم یک بود از سبد خرید حذف شود.
                if ($type == 'minus' && $cart_item->count == 1) {
                    $cart_item->delete();
                    return 'آیتم موردنظر از سبد خرید حذف شد.';

                }else{
                    if ($type == 'add') {
                        $cart_item->count++; // یه دونه به مقدارش اضافه بشه.
                    }else{
                        $cart_item->count--;
                    }
                    
                    $cart_item->payable = $cart_item->count * $product->cost; // تعداد محصول ضربدر قیمت نهایی = قیمت قابل پرداخت
                    $cart_item->save();
                }
            }else{ // اگر محصول در کارت نیست ایجاد شود.
                // ایجاد CartItem
                $cart_item = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'count' => 1,
                    'payable' => $product->cost, // قیمت محصول پس از محاسبه تخفیف
                ]);
            }
            
            // return back()->withMessage('آیتم موردنظر به سبد خرید اضافه شد.'); // چون با ajax ارسال می کنیم فقط return میکنیم.
            return [
                'message' => 'آیتم موردنظر به سبد خرید اضافه شد.',
                'count' => $cart_item->count,
            ];
            
        }else{
            return [
                'error' => 'لطفا ابتدا وارد حساب کاربری خود شوید.',
            ]; // اگر کاربر لاگین نکرده بود.
        }
    
    }

    // حذف از سبد خرید  
    public function remove(CartItem $cart_item)
    {
        // dd($cart_item);
        $cart_item->delete();
        return [
            'message' => 'آیتم موردنظر لز سبد خرید شما حذف شد.',
            'count' => 0,
        ];
    }

    // پرداخت و تسویه حساب
    public function finish()
    {
        // dd('here');
        $cart = Cart::where('user_id', auth()->id())->where('finished', 0)->first();// اونجایی که کاربر جاری همون کاربر سبده و اونجایی که سبد هنوز تسویه نشده از دیتابیس استخراج کن
        // auth()->user == هلپر لاراول به جای $currentLogedInUser = auth()->user();
        
        // اگر کارتی پیدا نشد
        if (!$cart) {
            return back()->withError('سبد خریدی وجود ندارد!');
        }
        $cart->finished = 1;
        $cart->code = rand(100000, 999999); // عداد رندم 6 رقمی برای کد پیگیری
        $cart->save();
        return back()->withMessage("پرداخت شما با موفقیت در سیستم ثبت شد. کد پیگیری : $cart->code");

    }

}


