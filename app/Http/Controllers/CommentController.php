<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'text' => 'required',
        ]);

        $comment = new Comment();
        $comment->name = $validatedData['name'];
        $comment->text = $validatedData['text'];
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post);
    }

public function destroy(Comment $comment)
{
$comment->delete();
return redirect()->back();
}
}
