<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cart_id'); // محصولات سبد خرید متعلق به چه سبد خریدی است؟
            $table->unsignedInteger('product_id'); 
            $table->unsignedSmallInteger('count'); // تعداد هر محصول در سبد خرید
            $table->unsignedBigInteger('payable'); // مشخص کردن قیمت نهایی محصول. ممکن است محصول مدتی در سبد خرید کاربر بماند و قیمتش تغییر کند.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
