<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // برای رسیدن به نام محصول از product_id در این جدول و نمایش آن در سبد خرید
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
