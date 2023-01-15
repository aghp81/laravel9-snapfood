@extends('layouts.landing')

@section('content')

    <h3> محصولات  </h3>


    <div class="row">

        @foreach($products as $product)

            <div class="col-md-4 my-2 product-card">
                <div class="d-flex justify-content-between">
                    <h5>{{ $product->title }}</h5>

                    <p>
                        
                        <!-- اگر تخفیف داشت -->
                        @if($product->discount)

                            <span class="text-danger off mx-2">{{ number_format($product->price) }}</span>
                            <span>{{ number_format($product->cost) }}</span><!-- cost در مدل ساخته شد. -->

                        @else <!-- اگر تخفیف نداشت -->
                            <span>{{ number_format($product->price) }}</span>

                        @endif
                    </p>
                    
                </div>
                <hr>
            </div>

        @endforeach

    </div>

@endsection