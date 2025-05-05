<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('questions.index');
});

// ========== AUTHENTICATION ==========
Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index'); 
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'check'])->name('login.check'); 
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

Route::get('/ranking', function () {
    return "it is not my part"; 
})->name('ranking.index');

Route::post('/set-theme', [UserController::class, 'setTheme']);

// ========== Routes protégées (connecté) ==========
Route::prefix('user')->name('user.')->middleware('auth')->group(function() {
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    
    Route::get('/', [UserController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update'); Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
});