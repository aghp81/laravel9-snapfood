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
}
