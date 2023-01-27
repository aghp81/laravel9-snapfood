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
                <form class="d-flex justify-content-between align-items-center" method="post" action="{{ route('cart.manage', $product->id) }}">
                    
                    <!-- چون ریکوئست را با ajax میفرستیم csrf رو از اینجا حذف میک نیم. -->
                    
                    <a href=""> {{ $product->shop->title ?? '-' }} </a>

                    <div @if(!$product->isInCart())  class="hidden"  @endif> <!-- اگر در سبد خرید چیزی نبود هیدن شود. -->
                        <button type="button" name="type" value="minus" class="btn btn-warning btn-sm text-primary manage-cart"> - </button>
                        <span class="cart-count"> x </span> <!-- تعداد محصول در سبد خرید را به کاربر نشان می دهیم -->
                        <button type="button" name="type" value="add" class="btn btn-warning btn-sm text-primary manage-cart"> + </button>
                    </div>

                    <div @if($product->isInCart())  class="hidden"  @endif> <!-- اگر در سبد خرید چیزی بود هیدن شود. -->
                        <button type="button" name="type" value="add" class="btn btn-info btn-sm px-3 text-primary manage-cart">
                                    اضافه به سبد خرید 
                        </button>   
                    </div>

                        
                    <!-- اگر محصول در سبد خرید است. -->
                    @if($cart_item = $product->isInCart())

                        

                        @else <!-- اگر محصول در سبد خرید نیست اضافه شود. -->
                            
                    @endif
                    
                </form>

            </div>

        @endforeach

    </div>

    <hr class="mb-2">

    <!-- صفحه بندی -->
    {{ $products->links() }}

@endsection