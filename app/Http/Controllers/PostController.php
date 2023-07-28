<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function viewSinglePost(Post $post)
    {
        return view('single-post', ['post' => $post]);
    }

    public function createPost()
    {
        return view('create-post');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $postFormData = $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);
        $postFormData['title'] = strip_tags($postFormData['title']);
        $postFormData['content'] = strip_tags($postFormData['content']);
        $postFormData['user_id'] = auth()->id();

        $post = Post::create($postFormData);

        return redirect("/post/{$post->id}")->with('success', "Post Creation Successful");
    }
}
