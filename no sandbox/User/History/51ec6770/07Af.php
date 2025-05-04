<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('questions.index');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login'); 



Route::get('/tags', function () {
     return "it is not my part";
})->name('tags.index');

Route::get('/ranking', function () {
    return "it is not my part"; })->name('ranking.index');
