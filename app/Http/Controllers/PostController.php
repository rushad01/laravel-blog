<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function viewSinglePost(Post $post)
    {
        $post['content'] = Str::markdown($post->content);
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

        return redirect("/post/{$post->id}")->with('success', "Post Creation Successful.");
    }
}
