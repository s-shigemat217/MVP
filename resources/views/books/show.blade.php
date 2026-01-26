<x-header />
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本の詳細</h1>
    <x-button href="/books/form" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">
        本を追加<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </x-button>
</div>
<div class="flex gap-8 mt-8">
    <div class="w-3/12 flex flex-col gap-8">
        <div class="p-4 border border-gray-500 rounded-xl">
            <div class="flex justify-center">
            @if($book->cover_image_url)
                <img src="{{ $book->cover_image_url }}" alt="cover">
            @else
                <img src="https://placehold.jp/059669/ffffff/140x200.png?text=No%20Image" alt="no cover">
            @endif
            </div>
        </div>
        <div class="p-4 border border-gray-500 rounded-xl">
            <p class="text-lg font-semibold mb-4">クイックアクション</p>
            <ul class="flex flex-col gap-4">
                <li>
                    <x-button type="button" size="sm" variant="muted" class="w-full" disabled>
                        読書開始（未実装）
                    </x-button>
                </li>
                <li>
                    <x-button type="button" size="sm" variant="muted" class="w-full" disabled>
                        読了にする（未実装）
                    </x-button>
                </li>
                <li>
                    <x-button href="/books/{{ $book->id }}/edit" size="sm" variant="warning" class="w-full">
                        編集(未実装)
                    </x-button>
                </li>
                <li>
                    <form method="POST" action="/books/{{ $book->id }}">
                        @csrf
                        @method('DELETE')
                        <x-button
                            type="submit"
                            size="sm"
                            variant="danger"
                            class="w-full"
                            onclick="return confirm('本当に削除しますか？')"
                        >削除</x-button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="w-8/12 flex flex-col gap-8">
        <div class="p-4 border border-gray-500 rounded-xl">
            <p class="text-lg font-semibold mb-4">基本情報</p>
            <p class="">タイトル</p>
            <p class="">{{ $book->title }}</p>
            <p class="">著者</p>
            <p class="">{{ $book->author ?? '不明' }}</p>
            <p class="">出版社</p>
            <p class="">{{ $book->publisher ?? '不明' }}</p>
            <p class="">出版日</p>
            <p class="">{{ $book->published_date ?? '不明' }}</p>
            <p class="">ISBN</p>
            <p class="">{{ $book->isbn ?? '不明' }}</p>
            <p class="">ページ数</p>
            <p class="">{{ $book->page_count ?? '不明' }}</p>
        </div>
        <div class="flex gap-8">
            <div class="w-1/2 p-4 border border-gray-500 rounded-xl">
                <p class="text-lg font-semibold mb-4">購入・読書情報</p>
                <p class="">読書情報</p>
                <p class="">購入日</p>
                {{ $book->created_at->format('Y-m-d H:i') }}
                <p class="">読書開始日</p>
                <p class="">読書終了日</p>
            </div>
            <div class="w-1/2 p-4 border border-gray-500 rounded-xl">
                <p class="text-lg font-semibold mb-4">カテゴリー情報</p>
                <p class="">カテゴリー</p>
                <p class="">{{ $book->category ?? '不明' }}</p>
                <p class="">タグ</p>
                <div>
                    @if($book->tags && count($book->tags) > 0)
                        @foreach($book->tags as $tag)
                            <span class="inline-block bg-gray-200 text-gray-800 text-sm px-2 py-1 rounded mr-2">{{ $tag }}</span>
                        @endforeach
                    @else
                        <p>タグはありません。</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-4 border border-gray-500 rounded-xl">
            <p class="text-lg font-semibold mb-4">読書メモ</p>
            <div class="whitespace-pre-wrap">{{ $book->reading_notes ?? '読書メモはありません。' }}</div>
        </div>
    </div>
</div>
<x-footer />
