<?php

namespace App\Http\Controllers;

use App\Models\Commantaire;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommantaireController extends Controller
{
    public function test()
    {
        $user = User::findOrFail(2);

        $user->notify(new CommentNotification());

        dd('notification sent');
    }
    public function store(Request $request, Post $post)
    {

        $user_comment = $request->validate([
            'content' => 'required|min:3|string'
        ]);

        $comments = new Commantaire($user_comment);
        $comments->user_id = auth()->id();
        $comments->post_id = $post->id;
        $comments->save();
        return redirect()->back();
    }
}
