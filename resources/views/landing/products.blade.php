@extends('layouts.landing')

@section('content')

    <h3 class="text-center"> محصولات  </h3>
    <hr>

    <!-- فرم جستجو -->
    <form action="" method="get" class="row justify-content-center align-items-center">
        <div class="col-md-4 form-group mb-3">
            <label class="mb-2" for=""> نام محصول </label>
            <input type="text" name="p" class="form-control" value="{{ request('p') }}">
        </div>
        <div class="col-md-4 form-group mb-3">
            <label class="mb-2" for=""> مرتب سازی بر اساس  </label>
            <select name="o" id="" class="form-control">
                <option value=""> -- انتخاب کنید -- </option>
                <option value="1" @if(request('o') == 1)  selected   @endif> جدیدترین </option>
                <option value="2" @if(request('o') == 2)  selected   @endif> ارزان ترین </option>
                <option value="3" @if(request('o') == 3)  selected   @endif> گران ترین </option>
            </select>
        </div>

        <!-- دکمه جستجو -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary text-info mt-3"> جستجو </button>
        </div>

    </form> 

    <hr>


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