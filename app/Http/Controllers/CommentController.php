<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $class = 'App\Models\\'. $request->owner_type;
        // dd($class);
        Comment::create([
            'owner_id' => $request->owner_id,
            'owner_type' => $class,
            'text' => $request->text
        ]);

        return back()->withMessage('کامنت شما با موفقیت ارسال شد.');
    }
}
