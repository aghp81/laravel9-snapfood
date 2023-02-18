@extends('layouts.landing')

@section('content')

    <h3>  سبد خرید شما   </h3>

    <hr class="mt-3">
    <!-- اگر کارت داشتیم جدول سبد خرید رو نشون بده -->
    @if($cart)

        <!-- جدول نمایش محتویات سبد خرید -->
        @include('landing.fragments.cart_table', ['operations' => true])

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