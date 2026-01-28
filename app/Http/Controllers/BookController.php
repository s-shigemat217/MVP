<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Book;

class BookController extends Controller
{
    // Display a listing of the books.
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book.
    public function form()
    {
        return view('books.form');
    }

    // Search for books using an external API.
    public function search(Request $request)
    {
        $q = $request->query('q');
        if ($q === '') {
            // 何も入力されていない場合はフォームだけ表示
            return view('books.form', [
                'books' => [],
                'q' => $q,
                'registeredSourceIds' => [],
            ]);
        }

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
    }

    // Store a newly created book from external API data.
    public function storeFromApi(Request $request)
    {
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
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
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

        return redirect()
            ->route('books.show', ['book' => $book->id])
            ->with('message', '更新しました');
    }

    // Remove the specified book from storage.
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('message', '書籍を削除しました。');
    }





}
