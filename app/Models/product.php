<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = ['id']; // فقط id گارد بشه بقیه همه Fillable هستند.

    //هر محصول مرتبط به یک فروشگاه است 
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
