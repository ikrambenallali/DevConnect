<?php

namespace App\Http\Controllers;

use App\Models\language_programmation;
use Illuminate\Http\Request;

class LanguageProgController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
        language_programmation::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languageProgs = language_programmation::where('user_id', $id)->get();
        return view('profile.edit', compact('languageProgs'));
    }
    public function afficher(string $id)
    {
        $languageProgs = language_programmation::where('user_id', $id)->get();
        return view('profil', compact('languageProgs'));
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
    public function destroy( $id)
    {
        $languageProgs = language_programmation::find($id);

        $languageProgs->delete();
        return redirect()->back();    }
}
