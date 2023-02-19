<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart as Order;

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
        $orders = Order::paginate(10);
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
    public function destroy($id)
    {
        //
    }
}
