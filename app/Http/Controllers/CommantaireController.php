<?php

namespace App\Http\Controllers;

use App\Models\Commantaire;
use App\Models\Post;
use Illuminate\Http\Request;

class CommantaireController extends Controller
{
    public function store(Request $request,Post $post){
        
        $user_comment = $request->validate([
            'content' => 'required|min:3|string'
        ]);

        $comment = new Commantaire($user_comment);
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->back();

        

    }
}
