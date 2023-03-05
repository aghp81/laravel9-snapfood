@extends('layouts.landing')

@section('content')

    <h3> {{ $shop->title }} </h3>

    <hr class="mt-3">

    <div class="row">

        @foreach($products as $product)

            @include('landing.fragments.product_card')

        @endforeach

    </div>
    
    <hr>
    {{ $products->links() }}

    <!-- کامنت گذاری -->
    @include('landing.fragments.comments', ['list' => $shop->comments, 'owner_type' => 'Shop', 'owner_id' => $shop->id]) <!--  ارسال لیست کامنت های فروشگاه و اطلاعات فروشگاه-->

    
@endsection