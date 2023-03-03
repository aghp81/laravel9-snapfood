@extends('layouts.landing')

@section('content')



...

<hr>
<h4 class="my-3">در صورت تمایل می توانید کامنت بگذارید</h4>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <textarea name="text" class="form-control my-2" id="" rows="4" placeholder="متن کامنت"></textarea>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-primary mt-3">تایید</button>
            </div>
        </form>


@endsection
