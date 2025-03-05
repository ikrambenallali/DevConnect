<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\language_programmation;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languageProgs = language_programmation::where('user_id', auth()->id())->get();
        $users = User::where('id', '!=', auth()->id())->get();
        $connections = Connection::with('user')->where('status', 'accepter')->get();
        foreach ($users as $user) {
            $status = Connection::getConnectionStatus($user->id, auth()->user()->id);
            $user->connectionStatus = $status;
        }

        $posts = Post::with('user')->latest()->paginate(2);
        return view('dashboard',  compact('posts', 'users', 'languageProgs', 'connections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mesPosts()
    {
        $posts = Post::where('user_id', auth()->id())->get();
        return view('allPosts', compact('posts'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        
        // dd($request->all());
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => ['required'],
            'tags' => 'required|string',
        ]);
       
        // dd(auth()->user());

        $tagsArray = array_filter(explode('#', ltrim($request->tags, '#')));
        $imagepath = $request->file('image') ? $request->file('image')->store('posts', 'public') : null;
        
        $post = Post::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'image' => $imagepath,
            'user_id' => auth()->user()->id,

        ]);

        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);

        return redirect()->back();
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('editPost', ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'tag_id' => ['required'],
            'description' => ['required']
        ]);
        $ImagePath = $request->file('image') ? $request->file('image')->store('posts', 'public') : $post->image;

        $post->update([
            'user_id' => auth()->id(),
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
