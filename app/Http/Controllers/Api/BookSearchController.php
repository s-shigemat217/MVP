<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoogleBooksService;
use Illuminate\Http\Request;


class BookSearchController extends Controller
{
    // GET /api/books/search
    public function search(Request $request, GoogleBooksService $googleBooksService){
        $query = $request->query('q');

        if (!$query) {
            return response()->json(['message' => '検索クエリが必要です'], 400);
        }

        $maxResults = (int) config('services.google_books.max_results', 10);
        $result = $googleBooksService->search($query, $maxResults);

        if (!$result['ok']) {
            return response()->json(['message' => '外部APIの呼び出しに失敗しました'], 502);
        }

        return response()->json($result['books']);
    }
}
