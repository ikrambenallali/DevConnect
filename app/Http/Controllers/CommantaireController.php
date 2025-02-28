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

        $comments = new Commantaire($user_comment);
        $comments->user_id = auth()->id();
        $comments->post_id = $post->id;
        $comments->save();
        return redirect()->back();

        

    }
}
