<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//default laravel routes
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// admin(dashboard) routes
    // shop resource route
Route::resource('shop', 'ShopController')->except('show');

    // shop resource route

     //بازیابی محصول سافت دیلیت شده
Route::post('product/{id}/restore', 'ProductController@restore')->name('product.restore');
Route::resource('product', 'ProductController')->except('show');


// public routes صفحه اصلی
// landing/products
Route::get('landing/{page}', 'LandingController@loadPage')->name('landing');


// cart routes
Route::post('cart/manage/{product}', 'CartController@manage')->name('cart.manage');
    //remove item from CartItem
Route::delete('cart/cart_item', 'CartController@remove');