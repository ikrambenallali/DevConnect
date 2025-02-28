<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();
        
        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $post->likes()->create([
                'user_id' => auth()->id()
            ]);
            $isLiked = true;
        }
        
        return response()->json([
            'success' => true,
            'likesCount' => $post->likes()->count(),
            'isLiked' => $isLiked
        ]);
    }

    public function checkLike(Post $post)
    {
        return response()->json([
            'isLiked' => $post->likes()->where('user_id', auth()->id())->exists()
        ]);
    }


}

