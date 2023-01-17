@extends('layouts.landing')

@section('content')

    <h3> محصولات  </h3>


    <div class="row">

        @foreach($products as $product)

            <div class="col-md-4 my-3 product-card">
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
                    <!-- اگر تصویر نداشت تصویر پیشفرض -->
                <img src="{{ asset($product->image ?? 'img/empty.jpg') }}" alt="{{ $product->title }}">
                
                <p class="mt-3">
                    @if($product->description)
                        {{ $product->description }} 
                    @else
                        <em> بدون توضیحات ...</em>
                    @endif
                </p>
                <hr class="mt-3 mb-3">
                
                <!-- نمایش نام فروشگاه -->
                <div class="d-flex justify-content-between align-items-center">
                    <a href=""> {{ $product->shop->title ?? '-' }} </a>

                    <button type="button" class="btn btn-info btn-sm px-3 text-primary"> اضافه به سبد خرید </button>


                </div>
            </div>

        @endforeach

    </div>

    <hr class="mb-2">

    <!-- صفحه بندی -->
    {{ $products->links() }}

@endsection