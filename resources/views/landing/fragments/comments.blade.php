<div>
        <h2 class="text-center mt-3"> لیست کامنت ها </h2>
        <hr>

        <!-- لیست کامنت ها -->
        @foreach($shop->comments as $comment)
            <div class="alert alert-info my-2">
                {{ $comment->text }}

                <hr>
                {{ persianDate($comment->created_at) }}
            </div>
            
        @endforeach

       تعداد کامنت ها: {{$shop->comments->count()}}


        <h4 class="my-3">در صورت تمایل می توانید کامنت بگذارید</h4>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <textarea name="text" class="form-control my-2" id="" rows="4" placeholder="متن کامنت"></textarea>
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-primary mt-3">تایید</button>
            </div>
        </form>
    </div>