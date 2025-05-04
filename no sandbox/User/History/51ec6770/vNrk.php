<?php

use Illuminate\Support\Facades\Route;

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
