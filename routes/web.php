<?php

use App\Http\Controllers\CommantaireController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\LanguageProgController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/addComp', [CompetenceController::class, 'create'])->name('addComp');
    Route::delete('/compoetence/{competence}', [CompetenceController::class, 'destroy'])->name('competence.destroy');
    Route::delete('/languageProg/{languageProg}', [LanguageProgController::class, 'destroy'])->name('languageProg.destroy');
    Route::post('/ajouterCompetence', [CompetenceController::class, 'store'])->name('ajouterCompetence');
    Route::post('/ajouterLanguagePro', [LanguageProgController::class, 'store'])->name('ajouterLanguagePro');
    Route::post('/dashboard/addComment/{post}', [CommantaireController::class, 'store'])->name('dashboard.addComment');
    Route::get('/showCompetence/{id}', [CompetenceController::class, 'show'])->name('showCompetence');
    Route::get('/showLanguage/{id}', [LanguageProgController::class, 'show'])->name('showLanguage');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/dashboard/addPost', [PostController::class, 'store'])->name('dashboard.addPost');
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::get('/editPost/{post}', [PostController::class, 'edit'])->name('editPost');
    Route::put('/updatePost/{post}', [PostController::class, 'update'])->name('updatePost');
    Route::delete('/dashboard/{post}', [PostController::class, 'destroy'])->name('dashboard.destroy');


});

require __DIR__ . '/auth.php';
    