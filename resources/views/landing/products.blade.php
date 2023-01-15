@extends('layouts.landing')

@section('content')

    <h3> محصولات  </h3>


    <div class="row">

        @foreach($products as $product)

            <div class="col-md-4 my-2">
                <div class="d-flex justify-content-between">
                    <h5>{{ $product->title }}</h5>
                    <span>{{ $product->price }}</span>
                </div>
                <hr>
            </div>

        @endforeach

    </div>

@endsection