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
    $maxResults = (int) config('services.google_books.max_results', 10);

    $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
        'q' => 'intitle:' . $q,
        'maxResults' => $maxResults,
    ]);

    $books = $response->json()['items'] ?? [];

    $sourceIds = collect($books)
        ->pluck('id')
        ->filter()
        ->values()
        ->all();

    $registeredSourceIds = [];
    if (!empty($sourceIds)) {
        $registeredSourceIds = Book::where('source', 'google_books')
            ->whereIn('source_id', $sourceIds)
            ->pluck('source_id')
            ->all();
    }

    return view('books.form', compact('books', 'q', 'registeredSourceIds'));
});

// Add a new book from external API data
Route::post('/books/from-api', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'string'],
        'author' => ['nullable', 'string'],
        'publisher' => ['nullable', 'string'],
        'published_date' => ['nullable', 'string'],
        'cover_image_url' => ['nullable', 'string'],
        'purchase_price' => ['nullable', 'integer', 'min:0'],
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

// Show book details
Route::get('/books/{book}', function (Book $book) {
    return view('books.show', compact('book'));
});

Route::get('/books/{book}/edit', function (Book $book) {
    return view('books.edit', compact('book'));
});

Route::patch('/books/{book}', function (Request $request, Book $book) {
    $validated = $request->validate([
        'title' => ['required', 'string'],
        'author' => ['nullable', 'string'],
        'publisher' => ['nullable', 'string'],
        'published_date' => ['nullable', 'string'],
        'page_count' => ['nullable', 'integer', 'min:1'],
        'purchased_date' => ['nullable', 'date'],
        'purchase_price' => ['nullable', 'integer', 'min:0'],
        'reading_started_date' => ['nullable', 'date'],
        'reading_finished_date' => ['nullable', 'date'],
        'category' => ['nullable', 'string'],
        'tags' => ['nullable', 'string'],
        'reading_notes' => ['nullable', 'string'],
    ]);

    $tagsInput = $validated['tags'] ?? null;
    $tags = null;
    if ($tagsInput !== null) {
        $tags = collect(explode(',', $tagsInput))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();
    }

    $book->update([
        'title' => $validated['title'],
        'author' => $validated['author'] ?? null,
        'publisher' => $validated['publisher'] ?? null,
        'published_date' => $validated['published_date'] ?? null,
        'page_count' => $validated['page_count'] ?? null,
        'purchased_date' => $validated['purchased_date'] ?? null,
        'purchase_price' => $validated['purchase_price'] ?? null,
        'reading_started_date' => $validated['reading_started_date'] ?? null,
        'reading_finished_date' => $validated['reading_finished_date'] ?? null,
        'category' => $validated['category'] ?? null,
        'tags' => $tags,
        'reading_notes' => $validated['reading_notes'] ?? null,
    ]);

    return redirect("/books/{$book->id}")
        ->with('message', '書籍情報を更新しました');
});

Route::delete('/books/{book}', function (Book $book) {
    $book->delete();

    return redirect('/books')
        ->with('message', '書籍を削除しました');
});
