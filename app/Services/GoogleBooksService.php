<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleBooksService
{
    public function search(string $query, int $maxResults = 10): array
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $query,
            'maxResults' => $maxResults,
        ]);

        if ($response->failed()) {
            return [
                'ok' => false,
                'books' => [],
            ];
        }

        $items = $response->json('items') ?? [];

        $books = collect($items)->map(function ($item) {
            $volumeInfo = $item['volumeInfo'] ?? [];

            $isbn13 = collect($volumeInfo['industryIdentifiers'] ?? [])
                ->firstWhere('type', 'ISBN_13')['identifier'] ?? null;

            $thumbnail = $volumeInfo['imageLinks']['thumbnail'] ?? null;

            return [
                'title' => $volumeInfo['title'] ?? 'タイトル不明',
                'authors' => $volumeInfo['authors'] ?? [],
                'publisher' => $volumeInfo['publisher'] ?? '出版社不明',
                'publishedDate' => $volumeInfo['publishedDate'] ?? '発行日不明',
                'isbn' => $isbn13,
                'coverImageUrl' => $thumbnail,
            ];
        })->values()->all();

        return [
            'ok' => true,
            'books' => $books,
        ];
    }
}
