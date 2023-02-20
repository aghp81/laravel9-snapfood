<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart as Order;
use App\Models\CartItem;

class OrderController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth'); // چک کردن لاگین بودن کاربر
         $this->middleware('admin')->only('destroy'); // destroy فقط برای ادمین
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentLoggedInUser = auth()->user();
        $orders = Order::query();
        if ($currentLoggedInUser->role == 'user') {
            $orders = $orders->where('user_id', $currentLoggedInUser->id);
        }
        $orders = $orders->paginate(10);
        return view ('order.index', compact('orders'));
    }

    //نمایش جزئیات سفارش 
    public function show(Order $order)
    {
        // dd($order);
        return view ('order.show', compact('order'));
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // dd($order);
        $order->delete(); // حذف کارت
        CartItem::where('cart_id', $order->id)->delete(); // حذف کارت آیتم های مربوط به همان کارت
        return back()->withMessage( __('DELETED') ); // DELETED in fa.json

    }
}
