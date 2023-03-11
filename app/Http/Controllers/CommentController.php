<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'text' => 'required',
            'commentImage' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('commentImage')) {
            $imagePath = $request->file('commentImage')->store('public/images');
            $validatedData['commentImage'] = $request->file('commentImage')->store('/images');
        }

        $comment = new Comment();
        $comment->name = $validatedData['name'];
        $comment->text = $validatedData['text'];
        if ($request->hasFile('commentImage')) {$comment->commentImage = $validatedData['commentImage'];}
        $comment->post_id = $post->id;
        $comment->save();



        return redirect()->route('posts.show', $post);
    }

public function destroy(Comment $comment)
{
    if(isset($comment->commentImage)) {
        Storage::delete($comment->commentImage);
    }
    $comment->delete();
    return redirect()->back();
}


}


