<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


// ========== AUTHENTICATION ==========
Route::get('/register', [RegisterController::class, 'index'])->name('register.index'); 
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'check'])->name('login.check'); 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 


Route::get('/', function () {
    return redirect()->route('questions.index');
});
Route::get('/questions', function () {
    return view('home');
})->name('questions.index');




Route::get('/tags', function () {
     return "it is not my part";
})->name('tags.index');

Route::get('/ranking', function () {
    return "it is not my part"; })->name('ranking.index');
