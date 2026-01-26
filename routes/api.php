<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookSearchController;

// Book management routes
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::post('/books/from-api', [BookController::class, 'storeFromApi']);

// Book search route
Route::get('/books/search', [BookSearchController::class, 'search']);
