<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        Comment::create([
            'shop_id' => $request->shop_id,
            'text' => $request->text
        ]);

        return back()->withMessage('کامنت شما با موفقیت ارسال شد.');
    }
}
