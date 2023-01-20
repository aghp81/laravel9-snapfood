<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // ارتباط بین کارت و کارت آیتم. هر کارت تعداد زیادی کارت آیتم دارد.
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
