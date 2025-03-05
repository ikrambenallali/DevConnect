<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Certification;
use App\Models\Competence;
use App\Models\language_programmation;
use App\Models\Projet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $competences = Competence::where('user_id', $request->user()->id)->get();
        $languageProgs = language_programmation::where('user_id', $request->user()->id)->get();
        $certfications = Certification::where('user_id', $request->user()->id)->get();
        $projets = Projet::where('user_id', $request->user()->id)->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'competences' => $competences,
            'languageProgs' => $languageProgs,
            'certfications' => $certfications,
            'projets' => $projets

        ]);
    }
    public function updateProfilePicture(Request $request)
{
    // Valider la requête pour l'image de profil uniquement
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validation pour l'image
    ]);

    $user = Auth::user();
    
    // Vérifiez si une image a été téléchargée
    if ($request->hasFile('profile_picture')) {
        // Supprimer l'ancienne image de profil, si elle existe
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Enregistrez la nouvelle image
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Mettez à jour le chemin de l'image de profil dans la base de données
        $user->profile_picture = $imagePath;
        $user->save();
    }

    return redirect()->route('profile.edit')->with('status', 'Photo de profil mise à jour avec succès.');
}


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
