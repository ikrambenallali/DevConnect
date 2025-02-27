<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(2);
        return view('dashboard',["posts"=> $posts]);
        dd($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request-> validate([
            'titre'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'image' => ['required'],
            'tag_id'=>['required'],
            
        ]);
        
        $imagepath = $request->file('image') ? $request->file('image')->store('posts', 'public') : null;
        Post::create([
         'titre'=>$request->titre,
         'description'=>$request->description,
         'tag_id'=>$request->tag_id,
         'image' => $imagepath,
         'user_id'=>auth()->user()->id,
         'tag_id'=>1,
        ]);
       
        return redirect()->back();
    }
  


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('editPost',["post" => $post]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'tag_id' => ['required'],
            'description' => ['required']     
        ]);
   $ImagePath= $request->file('image') ? $request->file('image')->store('posts', 'public') : $post->image; 
   
    $post->update([
    'user_id'=>auth()->id(),
    'titre' => $request->titre,
    'tag_id' => $request->tag_id,
    'description' => $request->description,
    'image' => $ImagePath,
]);

return redirect()->back();  
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
