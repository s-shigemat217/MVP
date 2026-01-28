<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Welcome route
Route::get('/', fn () => view('welcome'));

// Book management routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/form', [BookController::class, 'form'])->name('books.form');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::post('/books/from-api', [BookController::class, 'storeFromApi'])->name('books.storeFromApi');

// Edit, Update, Delete routes for books management(後ほどミドルウェアを適用)
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
