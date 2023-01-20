@extends('layouts.landing')

@section('content')

    <h3>  سبد خرید شما   </h3>

    <hr class="mt-3">

    <!-- جدول نمایش محتویات سبد خرید -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> محصول </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
            </tr>
        </thead>

        <tbody>
            <!-- LandingController cart method -->
            <!-- each cart has many cart items -->
            @foreach ($cart->items as $key => $item)
            <tr>
                <th> {{ $key+1 }} </th>
                <td> {{ $item->product->title ?? '--' }} </td> <!-- CartItem.php - public function product() --> 
                <td> {{ $item->count }} </td>
                <td> {{ number_format($item->payable) }} </td>
            </tr>
            @endforeach
            <!-- جمع سبد خرید -->
            <tr>
                <td colspan="3"> جمع کل </td>
                <td> {{ number_format($cart->sum) }} تومان</td> <!-- Cart.php - getSumAttribute() -->
            </tr>
        </tbody>
    </table>

@endsection