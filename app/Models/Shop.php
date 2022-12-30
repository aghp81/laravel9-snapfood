<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = ['id']; // فقط id گارد بشه بقیه همه Fillable هستند.
    
    // استفاده از appends برای نمایش نام و نام خانوادگی در کنار هم
    protected $appends = ['full_name']; 

    public function getFullNameAttribute () 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
