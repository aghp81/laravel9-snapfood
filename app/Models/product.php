<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id']; // فقط id گارد بشه بقیه همه Fillable هستند.
    protected $appends = ['cost'];// محاسبه قیمت پس از تخفیف

    
    // محاسبه قیمت پس از تخفیف
    public function getCostAttribute()
    {
        return $this->price - ( ($this->price * $this->discount) / 100);
    }

    
    //هر محصول مرتبط به یک فروشگاه است 
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // آیا یک محصول از قبل در کارت خرید وجود دارد؟
    public function isInCart()
    {
        $currentLogedInUser = auth()->user(); // باید ایتدا ببینیم کاربر لاگین کرده که بتوان سبد خرید او را بررسی کرد.
        // اگر کاربر لاگین کرده بود
        if ($currentLogedInUser) {
            $cart = Cart::where('user_id', $currentLogedInUser->id)->first(); // اگر کاربری داشتیم کارت رو پیدا کنه.
            // اگر کارتی پیدا کرد
            if ($cart) {
               return CartItem::where('cart_id', $cart->id)->where('product_id', $this->id)->first(); // $this->id == $product->id چون در مدل پروداکت هستیم. first(); == اگر پیدا کرد کارت ایتم رو برگردونه
            }
        }
    }
}
