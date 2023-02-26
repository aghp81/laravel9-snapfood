<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart as Order;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Shop;

class OrderController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth'); // چک کردن لاگین بودن کاربر
         $this->middleware('admin')->only('destroy'); // destroy فقط برای ادمین
         $this->middleware('admins')->only('changeStatus'); // changeStatus  فقط برای ادمینها فروشنده و مدیر
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentLoggedInUser = auth()->user();
        // اگر کاربر فروشنده باشد نمایش در ویوی دیگر
        if ($currentLoggedInUser->role == 'shop') {

            // dd($currentLoggedInUser->id);

            $currentShop = Shop::where('user_id', $currentLoggedInUser->id)->first();

            // dd($currentShop);

            $pids = Product::where('shop_id', $currentShop->id)->pluck('id')->toArray(); // pluck('id') == فقط آی دی رو بگیر
            
            // dd($pids);

            $items = CartItem::whereIn('product_id', $pids)->paginate(10); // whereIn == $pids یک آرایه است.
            
            // dd($items);
            
            return view('order.shop_index', compact('items'));
        }else {

            $orders = Order::query();

        // هر کاربر فقط لیست سفارشات خودش را ببیند.
        if ($currentLoggedInUser->role == 'user') {
            $orders = $orders->where('user_id', $currentLoggedInUser->id);
        }
        $orders = $orders->paginate(10);
        return view ('order.index', compact('orders'));
        }
    }

    //نمایش جزئیات سفارش 
    public function show(Order $order)
    {
        // dd($order);
        return view ('order.show', compact('order'));
    }


    // برای تغییر وضعیت سفارشات
    public function changeStatus(CartItem $cart_item, Request $request)
    {
         // dd($cart_item, $request->all());

         $cart_item->status = $request->status;
         $cart_item->save();
         return back()->withMessage( __('SUCCESS') ); // DELETED in fa.json
        
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
