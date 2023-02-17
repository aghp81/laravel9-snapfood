@extends('layouts.landing')

@section('content')

    <h3> فروشگاه ها  </h3>

    <hr class="mt-3">

    @foreach($shops as $key => $shop)

        <div class="landing-shop-card">
            <h5 class="text-primary m-3"> {{ $shop->title }} </h5>
            <p> <b> آدرس: </b> {{ $shop->address ?? '-' }} </p>
            <div class="d-flex justify-content-around m-4">
                <span> {{ $shop->full_name }} </span>
                <span> {{ $shop->telephone }} </span>
                <span> {{ persianDate($shop->created_at) }} </span> <!-- persianDate == helpers.php -->
            </div>
            <hr>
            <a href="{{ route('shop.show', $shop->id) }}" class="btn btn-primary mt-3"> رفتن به فروشگاه </a>
        </div>

    @endforeach

    {{ $shops->links() }}

@endsection