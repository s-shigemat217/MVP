<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

// Get all books
Route::get('/books', function () {
    return Book::orderBy('created_at', 'desc')->get();
});

// Search books via external API (Google Books API)
Route::get('/books/search', function (Request $request) {
    $query = $request->query('q');

    if (!$query) {
        return response()->json([
            'message' => '検索クエリが必要です'
        ], 400);
    }

    $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
        'q' => $query,
        'maxResults' => 10,
    ]);

    if ($response->failed()) {
        return response()->json([
            'message' => '外部APIの呼び出しに失敗しました'
        ], 502);
    }

    $books = collect($response->json('items'))->map(function ($item) {
        $volumeInfo = $item['volumeInfo'] ?? [];

        return [
            'title' => $volumeInfo['title'] ?? 'タイトル不明',
            'authors' => $volumeInfo['authors'] ?? [],
            'publisher' => $volumeInfo['publisher'] ?? '出版社不明',
            'publishedDate' => $volumeInfo['publishedDate'] ?? '発行日不明',
            'isbn' => collect($volumeInfo['industryIdentifiers'] ?? [])->firstWhere('type', 'ISBN_13')['identifier'] ?? null,
            'coverImageUrl' => $volumeInfo['imageLinks']['thumbnail'] ?? null,
        ];
    });

    return response()->json($books);
});

// Add a new book
Route::post('/books', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'status' => ['nullable', 'in:owned,wishlist'],
    ]);

    if (Book::where('title', $validated['title'])->exists()) {
        return response()->json([
            'message' => 'すでに登録されています'
        ], 409);
    }

    $book = Book::create([
        'title' => $validated['title'],
        'status' => $validated['status'] ?? 'owned',
    ]);

    return response()->json($book, 201);
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

    if (Book::where('source', $validated['source'])
            ->where('source_id', $validated['source_id'])
            ->exists()) {
        return response()->json(['message' => 'すでに登録されています'], 409);
    }

    $book = Book::create([
        ...$validated,
        'status' => 'owned',
    ]);

    return response()->json($book, 201);
});
