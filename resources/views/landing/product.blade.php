@extends('layouts.landing')

@section('content')



...

<!-- کامنت گذاری -->
@include('landing.fragments.comments', ['list' => $product->comments, 'owner_type' => 'Product', 'owner_id' => $product->id]) <!--  ارسال لیست کامنت های محصول و اطلاعات محصول-->


@endsection
