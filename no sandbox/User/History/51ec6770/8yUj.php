<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/questions', function () {
    return "it is not my part";
})->name('questions.index');

Route::get('/tags', function () {
     return "it is not my part";
})->name('tags.index');

Route::get('/ranking', function () {
    return "it is not my part"; })->name('ranking.index');
