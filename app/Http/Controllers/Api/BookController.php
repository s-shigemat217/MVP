<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookRequest;
use App\Http\Requests\Api\StoreBookFromApiRequest;
use App\Models\Book;
use Illuminate\Http\Request;



class BookController extends Controller
{
    // GET /api/books
    public function index()
    {
        return Book::orderBy('created_at', 'desc')->get();
    }

    // POST /api/books
    public function store(StoreBookRequest $request)
    {


        $validated = $request->validated();

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
    }

    // POST /api/books/from-api
    public function storeFromApi(StoreBookFromApiRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        $alreadyExists = Book::where('source', $validated['source'])
            ->where('source_id', $validated['source_id'])
            ->exists();

        if ($alreadyExists) {
            return response()->json(['message' => 'すでに登録されています'], 409);
        }

        $book = Book::create([
            ...$validated,
            'status' => 'owned',
        ]);

        return response()->json($book, 201);
    }
}
