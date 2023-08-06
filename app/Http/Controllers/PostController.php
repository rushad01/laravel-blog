<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function delete(Request $request, Post $post)
    {
        if ($request->user()->cannot('delete', $post)) {
            return "You don't have permission for deleting this post post.";
        }
        $post->delete();
        //dd(auth()->user()->username);
        return redirect('/profile/' . auth()->user()->username)->with('success', "Successfully deleted the post.");
    }
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
    public function editPost(Post $post)
    {
        return view('edit-post', compact('post'));
    }

    public function updatePost(Post $post, Request $request)
    {
        $postUpdateFormData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        //dd($postUpdateFormData);
        $post->update($postUpdateFormData);
        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post Updated Successfully');
    }
}
