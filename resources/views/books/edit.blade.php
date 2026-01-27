<x-header />

<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本の情報を編集</h1>
    <x-button href="/books/{{ $book->id }}" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">
        詳細へ戻る<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </x-button>
</div>

<x-message />

<form method="POST" action="/books/{{ $book->id }}" class="mt-8">
    @csrf
    @method('PATCH')

    <div class="grid grid-cols-1 gap-6">
        <div>
            <label for="title" class="block mb-1 font-bold">タイトル</label>
            <input
                type="text"
                name="title"
                id="title"
                required
                value="{{ old('title', $book->title) }}"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="author" class="block mb-1 font-bold">著者</label>
            <input
                type="text"
                name="author"
                id="author"
                value="{{ old('author', $book->author) }}"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="publisher" class="block mb-1 font-bold">出版社</label>
            <input
                type="text"
                name="publisher"
                id="publisher"
                value="{{ old('publisher', $book->publisher) }}"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="published_date" class="block mb-1 font-bold">出版日</label>
            <input
                type="text"
                name="published_date"
                id="published_date"
                value="{{ old('published_date', $book->published_date) }}"
                placeholder="例: 2025-04-10"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="page_count" class="block mb-1 font-bold">ページ数</label>
            <input
                type="number"
                name="page_count"
                id="page_count"
                min="1"
                value="{{ old('page_count', $book->page_count) }}"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <label for="purchased_date" class="block mb-1 font-bold">購入日</label>
                <input
                    type="date"
                    name="purchased_date"
                    id="purchased_date"
                    value="{{ old('purchased_date', optional($book->purchased_date)->format('Y-m-d')) }}"
                    class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
                >
            </div>

            <div>
                <label for="purchase_price" class="block mb-1 font-bold">購入金額</label>
                <input
                    type="number"
                    name="purchase_price"
                    id="purchase_price"
                    min="0"
                    step="1"
                    value="{{ old('purchase_price', $book->purchase_price) }}"
                    placeholder="例: 1500"
                    class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
                >
            </div>

            <div>
                <label for="reading_started_date" class="block mb-1 font-bold">読書開始日</label>
                <input
                    type="date"
                    name="reading_started_date"
                    id="reading_started_date"
                    value="{{ old('reading_started_date', optional($book->reading_started_date)->format('Y-m-d')) }}"
                    class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
                >
            </div>

            <div>
                <label for="reading_finished_date" class="block mb-1 font-bold">読書終了日</label>
                <input
                    type="date"
                    name="reading_finished_date"
                    id="reading_finished_date"
                    value="{{ old('reading_finished_date', optional($book->reading_finished_date)->format('Y-m-d')) }}"
                    class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
                >
            </div>
        </div>

        <div>
            <label for="category" class="block mb-1 font-bold">カテゴリー</label>
            <input
                type="text"
                name="category"
                id="category"
                value="{{ old('category', $book->category) }}"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="tags" class="block mb-1 font-bold">タグ（カンマ区切り）</label>
            <input
                type="text"
                name="tags"
                id="tags"
                value="{{ old('tags', $book->tags ? implode(', ', $book->tags) : '') }}"
                placeholder="例: エッセイ, 哲学"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >
        </div>

        <div>
            <label for="reading_notes" class="block mb-1 font-bold">読書メモ</label>
            <textarea
                name="reading_notes"
                id="reading_notes"
                rows="6"
                class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
            >{{ old('reading_notes', $book->reading_notes) }}</textarea>
        </div>
    </div>

    <div class="mt-6">
        <x-button type="submit" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">保存する</x-button>
    </div>
</form>

<x-footer />
