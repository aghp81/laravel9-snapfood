@extends('layouts.landing')

@section('content')

    <h3>  سبد خرید شما   </h3>

    <hr class="mt-3">
    <!-- اگر کارت داشتیم جدول سبد خرید رو نشون بده -->
    @if($cart)

        <!-- جدول نمایش محتویات سبد خرید -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> محصول </th>
                <th> فروشگاه </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
                <th>  حذف </th>
            </tr>
        </thead>

        <tbody>
            <!-- LandingController cart method -->
            <!-- each cart has many cart items -->
            @foreach ($cart->items as $key => $item)
            <tr>
                <th> {{ $key+1 }} </th>
                <td> {{ $item->product->title ?? '--' }} </td> <!-- CartItem.php - public function product() --> 
                <td> {{ $item->product->shop->title ?? '--' }} </td> <!-- product.php - public function shop() --> 
                <td>
                    <form method="post" action="{{ route('cart.manage', $item->product_id) }}">
                        @csrf
                        <button type="submit" name="type" value="minus" class="btn btn-warning btn-sm text-primary"> - </button>
                        <span class="cart-count"> {{ $item->count }} </span> <!-- تعداد محصول در سبد خرید را به کاربر نشان می دهیم -->
                        <button type="submit" name="type" value="add" class="btn btn-warning btn-sm text-primary"> + </button>
                    </form>
                </td>
                <td> {{ number_format($item->payable) }} </td>
                <!--حذف از سبد خرید-->
                <td>
                    <form class="" action="{{route('cart.remove', $item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger bg-danger btn-sm"> حذف </button>
                    </form>
                </td>
            </tr>
            @endforeach
            <!-- جمع سبد خرید -->
            <tr>
                <td colspan="4"> جمع کل </td>
                <td colspan="2"> {{ number_format($cart->sum) }} تومان</td> <!-- Cart.php - getSumAttribute() -->
            </tr>
        </tbody>
    </table>

    <!-- دکمه پرداخت -->
    <form action="{{route('cart.finish')}}" method="post" class="text-center">
        @csrf    
        <button type="submit" class="btn btn-outline-primary"> تایید و پرداخت </button>
    </form>

    <!-- اگر کارت خالی بود -->
    @else
    <div class="alert alert-info">
        سبد خرید شما خالی است.
    </div>
    @endif
    

@endsection