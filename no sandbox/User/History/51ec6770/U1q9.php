<?php

use Illuminate\Support\Facades\Route;


Route::get('/register', function () {
    return view('auth.forms.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.forms.login');
})->name('login'); 



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
