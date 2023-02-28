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
    <div>
        <h2 class="text-center mt-3"> لیست کامنت ها </h2>
        <hr>
        <h4 class="my-3">در صورت تمایل می توانید کامنت بگذارید</h4>
        <form action="" method="post">
            <textarea name="text" class="form-control my-2" id="" rows="4" placeholder="متن کامنت"></textarea>
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-primary mt-3">تایید</button>
            </div>
        </form>
    </div>
@endsection