<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserActiviteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReponseController;

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
//Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');

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
    Route::post('/questions/{question}/reponses', [ReponseController::class, 'store'])->name('reponses.store');
    Route::get('/questions/{question}', [QuestionController::class, 'showQuestion'])->name('profile.question');
    Route::get('/questions/question/askform', [QuestionController::class, 'questionForm'])->name('questions.questionform');

    //Route pour la reponses
    Route::get('/reponses/{reponse}', [ReponseController::class, 'show'])->name('reponses.show');
    Route::put('/reponses/{reponse}', [ReponseController::class, 'update'])->name('reponses.update');
    Route::delete('/reponses/{reponse}', [ReponseController::class, 'destroy'])->name('reponses.destroy');

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
    Route::get('/creer-groupe', [GroupController::class, 'creerpage'])->name('user.groups.creer'); //Pour afficher  le formulaire de création de
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store'); // Pour créer de nouvelles groupes
    
    //Pour gérer un groupe spécifiques   
    Route::prefix('group')->group(function() {
        Route::get('/{group}', [GroupController::class, 'show'])->name('group.show'); //on affichera les questions par défaut
        Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
        Route::put('/{group}', [GroupController::class, 'update'])->name('group.update');
        Route::delete('/{group}', [GroupController::class, 'destroy'])->name('group.destroy');
        
        // Messages dans un groupe spécifique
        Route::get('/{group}/messages', [GroupController::class, 'showMessages'])->name('group.messages');
        Route::post('/{group}/messages', [MessageController::class, 'store'])->name('group.messages.store');
        
        // Gestion des membres
        Route::get('/{group}/membres', [GroupController::class, 'gmembres'])->name('group.membres');
        Route::post('/{group}/join', [GroupController::class, 'join'])->name('group.join');
        Route::post('/{group}/leave', [GroupController::class, 'leave'])->name('group.leave');
        Route::post('/{group}/invite', [GroupController::class, 'invite'])->name('group.invite');
        
        // Reponses
        
    });



});