<?php

namespace App\Http\Controllers;

use App\Events\BlogChat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatView()
    {
        return view("blog-chat");
    }

    public function newChat(Request $request)
    {
        $formFields = $request->validate([
            'chatmessage' => 'required',
        ]);
        $chatmessage = strip_tags($formFields['chatmessage']);
        broadcast(new BlogChat(auth()->user()->username, $chatmessage));
        return response()->noContent();
    }
}
