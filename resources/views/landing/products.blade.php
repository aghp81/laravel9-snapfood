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

            @include('landing.fragments.product_card')

        @endforeach

    </div>

    <hr class="mb-2">

    <!-- صفحه بندی -->
    {{ $products->links() }}

@endsection