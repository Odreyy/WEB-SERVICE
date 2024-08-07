<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request['user_id']= auth()->user()->id;

        $comment = Comment::create($request->all());

        return new CommentResource($comment->loadMissing(['commentator:id, username']));
    }

    public function update(Request $request, $id)
    {

    }
}
