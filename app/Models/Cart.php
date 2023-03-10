<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['sum', 'count']; // محاسبه جمع سبد خرید خارج از دیتابیس

    // محاسبه جمع سبد خرید خارج از دیتابیس
    public function getSumAttribute() // نام تابع باید اینگونه انتخاب شود.
    {
        return CartItem::where('cart_id', $this->id)->sum('payable');
    }
    
    // جمع عدد موجود در سبد خرید
    public function getCountAttribute()
    {
        return CartItem::where('cart_id', $this->id)->sum('count');
    }


    // ارتباط بین کارت و کارت آیتم. هر کارت تعداد زیادی کارت آیتم دارد.
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // نمایش نام کاربر در لیست سفارشات
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
