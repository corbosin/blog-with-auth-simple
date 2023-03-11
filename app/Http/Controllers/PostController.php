<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::All();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|max:2048',
            'name' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image'] = $request->file('image')->store('/images');
        }

        $post = Post::create($validatedData);

        return redirect()->route('posts.index', $post->id);
    }



        public function show(Post $post)
        {

            if (!$post) {
                abort(404);
            }
            $image = $post->image;
            $comments = $post->comments;
            return view('posts.show', compact('post'))->with('comments', $comments);
        }


    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.index', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
