<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserActiviteController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return redirect()->route('questions.index');
});

// ========== AUTHENTICATION ==========
Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index'); 
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'check'])->name('login.check'); 
    Route::get('/login/redirect', [LoginController::class, 'redirect'])->name('login.redirect');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

// ========== QUESTIONS ==========
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index'); 
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

// ========== GROUPS ==========
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');

Route::get('/tags', function () {
     return "it is not my part";
})->name('tags.index');

// Utilisateurs 
Route::get('/ranking', [UserController::class, 'ranking'])->name('ranking.index');


// ========== Routes protégées (connecté) ==========
Route::prefix('user')->name('user.')->middleware('auth')->group(function() {
    // ------------------Question tu peut ajouter le reste ici
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
  
    // Question Fin
    // --------------------------------------- User ici
    Route::get('/', [UserController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update'); 
    
    // --------------------------------------- Activites de l'utilisateurs 
    Route::get('/activites', [UserActiviteController::class, 'index'])->name('activites');
    Route::get('/activites/Questions', [UserActiviteController::class, 'useQuestions'])->name('activites.questions');
    Route::get('/activites/Responses', [UserActiviteController::class, 'useResponses'])->name('activites.responses');

    // --------------- Groupe ------------------------
    Route::get('/mes-groupes', [GroupController::class, 'mesGroupes'])->name('user.groups');
    Route::get('/creer-groupe', [GroupController::class, 'creerpage'])->name('user.groups.creer');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store'); //Pour créer de nouvelles groupes
   


Route::post('/groups/{group}/messages', [MessageController::class, 'store'])->name('groups.messages.store');


Route::get('/groups', [GroupController::class, 'index'])->name('users.groups');


});