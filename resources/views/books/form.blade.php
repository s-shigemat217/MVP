<x-header />

<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本を登録</h1>
        <x-button href="/books/" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">
            一覧を見る<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </x-button>
</div>

<x-message />

<form method="GET" action="/books/search">
    <div class="mb-4">
        <label for="q" class="block mb-1 font-bold">本のタイトルを入力</label>
        <input
            type="text"
            name="q"
            id="q"
            placeholder="本のタイトルを入力"
            required
            class="w-full px-2 py-2 border border-gray-300 rounded text-base bg-white"
        >
    </div>
        <x-button type="submit" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">検索</x-button>
</form>
@if(!empty($books))
<h2>検索結果：「{{ $q }}」</h2>

    <ul class="mt-16 grid grid-cols-5 gap-6">
    @php
        $registeredSourceIdMap = isset($registeredSourceIds) ? array_flip($registeredSourceIds) : [];
    @endphp
    @foreach($books as $book)
        @php
            $info = $book['volumeInfo'] ?? [];
            $sourceId = $book['id'] ?? null;
            $isRegistered = $sourceId && isset($registeredSourceIdMap[$sourceId]);
        @endphp

        <li class="border bg-white border-gray-500 rounded-lg p-4 flex flex-col gap-4">
            @php
                $thumbnail = $info['imageLinks']['thumbnail'] ?? null;
                if ($thumbnail) {
                    $thumbnail = str_replace('http://', 'https://', $thumbnail);
                }
            @endphp
            <div class="flex justify-center align-top">
                @if($thumbnail)
                    <img src="{{ $thumbnail }}" alt="cover" class="w-[150px] h-[212px] object-cover">
                @else
                    <img src="https://placehold.jp/cccccc/ffffff/150x212.png?text=No+Image" alt="no cover" class="w-[150px] h-[212px] object-cover">
                @endif
            </div>

            <div class="flex flex-col gap-1 min-h-[5.5rem]">
                <strong class="leading-snug">{{ $info['title'] ?? 'タイトル不明' }}</strong>
                <p class="text-sm">著者：{{ $info['authors'][0] ?? '不明' }}</p>
                <p class="text-sm">出版社：{{ $info['publisher'] ?? '不明' }}</p>
            </div>

            <form method="POST" action="/books/from-api" class="mt-auto">
                @csrf

                <input type="hidden" name="title" value="{{ $info['title'] ?? '' }}">
                <input type="hidden" name="author" value="{{ $info['authors'][0] ?? '' }}">
                <input type="hidden" name="publisher" value="{{ $info['publisher'] ?? '' }}">
                <input type="hidden" name="published_date" value="{{ $info['publishedDate'] ?? '' }}">
                <input type="hidden" name="cover_image_url" value="{{ $info['imageLinks']['thumbnail'] ?? '' }}">

                <input type="hidden" name="source" value="google_books">
                <input type="hidden" name="source_id" value="{{ $book['id'] }}">

                    @if($isRegistered)
                        <x-button type="button" size="sm" variant="muted" disabled>登録済み</x-button>
                    @else
                        <x-button type="submit" size="sm">登録</x-button>
                    @endif

            </form>
        </li>
    @endforeach
</ul>
@endif

<x-footer />
