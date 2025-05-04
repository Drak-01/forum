<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/questions', function () {
    return view('questions.index');
})->name('questions.index');

Route::get('/tags', function () {
    return view('tags.index');
})->name('tags.index');

Route::get('/ranking', function () {
    return view('ranking.index');
})->name('ranking.index');
