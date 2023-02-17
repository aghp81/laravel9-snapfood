@extends('layouts.landing')

@section('content')

    <h3> {{ $shop->title }} </h3>

    <hr class="mt-3">

    <div class="row">

        @foreach($shop->products as $product)

            @include('landing.fragments.product_card')

        @endforeach

    </div>
    
@endsection