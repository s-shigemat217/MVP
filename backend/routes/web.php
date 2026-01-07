<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\Book;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', function () {
    $books = Book::orderBy('created_at', 'desc')->get();
    return view('books.index', compact('books'));
});

Route::get('/books/form', function () {
    return view('books.form');
});

Route::get('/books/search', function (Request $request) {
    $q = $request->query('q');

    $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
        'q' => 'intitle:' . $q,
        'maxResults' => 10,
    ]);

    $books = $response->json()['items'] ?? [];

    return view('books.form', compact('books', 'q'));
});

// Add a new book from external API data
Route::post('/books/from-api', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'string'],
        'author' => ['nullable', 'string'],
        'publisher' => ['nullable', 'string'],
        'published_date' => ['nullable', 'string'],
        'cover_image_url' => ['nullable', 'string'],
        'source' => ['required', 'string'],
        'source_id' => ['required', 'string'],
    ]);

    if (
        Book::where('source', $validated['source'])
            ->where('source_id', $validated['source_id'])
            ->exists()
    ) {
        return back()->with('message', 'すでに登録されています');
    }

    Book::create([
        ...$validated,
        'status' => 'owned',
    ]);

    return back()->with('message', '登録しました');
});
