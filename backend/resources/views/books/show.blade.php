<x-header />
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本の詳細</h1>
    <a href="/books/form" class="inline-flex items-center w-full px-5 py-3 mb-3 mr-1 text-base font-semibold text-white no-underline align-middle bg-blue-600 border border-transparent border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700">
        本を追加<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>
<div class="container flex gap-8 mt-8">
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
                    <button
                        type="button"
                        disabled
                        class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold
                            bg-slate-200 text-slate-500 cursor-not-allowed"
                    >読書開始（未実装）</button>
                </li>
                <li>
                    <button
                        type="button"
                        disabled
                        class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold
                            bg-slate-200 text-slate-500 cursor-not-allowed"
                    >読了にする（未実装）</button>
                </li>
                <li>
                    <a
                        href="/books/{{ $book->id }}/edit"
                        class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold
                            bg-yellow-500 text-white hover:bg-yellow-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-300"
                    >編集(未実装)</a>
                </li>
                <li>
                    <form method="POST" action="/books/{{ $book->id }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('本当に削除しますか？')"
                            class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold bg-red-600 text-white hover:bg-red-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-300"
                        >削除</button>
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
