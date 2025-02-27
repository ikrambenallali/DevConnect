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
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
