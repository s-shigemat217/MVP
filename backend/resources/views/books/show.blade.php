<x-header />
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">本の詳細</h1>
    <a href="/books/" class="inline-flex items-center w-full px-5 py-3 mb-3 mr-1 text-base font-semibold text-white no-underline align-middle bg-blue-600 border border-transparent border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700">
        本を追加<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>
<div class="container book-detail">
    <div class="left-content">
        <div class="card book-cover">
            <div class="img">
            @if($book->cover_image_url)
                <img src="{{ $book->cover_image_url }}" alt="cover">
            @else
                <img src="https://placehold.jp/059669/ffffff/140x200.png?text=No%20Image" alt="no cover">
            @endif
            </div>
        </div>
        <div class="card p-4">
            <p class="column-head">クイックアクション</p>
            <ul class="flex flex-col gap-4">
                <li>
                    <button class="qa-btn qa-btn--start" type="button" disabled>読書開始（未実装）</button>
                <li>
                    <button class="qa-btn qa-btn--finish" type="button" disabled>読了にする（未実装）</button>
                </li>
                {{-- <li><a class="qa-btn qa-btn--edit" href="/books/{{ $book->id }}/edit" )>編集(未実装)</a></li> --}}
                <li>
                    <form method="POST" action="/books/{{ $book->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="qa-btn qa-btn--delete" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </li>
            </ul>
        </div>
        {{-- <div class="card reading-progress">
            <p class="column-head">読書進捗</p>
        </div> --}}
    </div>
    <div class="right-content">
        <div class="card basic-infomation">
            <p class="column-head">基本情報</p>
            <div class="card-item">
                <p class="head">タイトル</p>
                <p class="body">{{ $book->title }}</p>
            </div>
            <div class="card-item">
                <p class="head">著者</p>
                <p class="body">{{ $book->author ?? '不明' }}</p>
            </div>
            <div class="card-item">
                <p class="head">出版社</p>
                <p class="body">{{ $book->publisher ?? '不明' }}</p>
            </div>
            <div class="card-item">
                <p class="head">出版日</p>
                <p class="body">{{ $book->published_date ?? '不明' }}</p>
            </div>
            <div class="card-item">
                <p class="head">ISBN</p>
                <p class="">{{ $book->isbn ?? '不明' }}</p>
            </div>
            <div class="card-item">
                <p class="head">ページ数</p>
                <p class="body">{{ $book->page_count ?? '不明' }}</p>
            </div>
        </div>
        <div class="reading-infomation">
            <div class="card date-infomation">
                <p class="column-head">購入・読書情報</p>
                <p class="">読書情報</p>
                <p class="">購入日</p>
                {{ $book->created_at->format('Y-m-d H:i') }}
                <p class="">読書開始日</p>
                <p class="">読書終了日</p>
            </div>
            <div class="card category-infomation">
                <p class="column-head">カテゴリー情報</p>
                <p class="">カテゴリー</p>
                <p class="">タグ</p>
            </div>
        </div>
        <div class="card memo">
            <p class="column-head">カテゴリー情報</p>
        </div>
    </div>
</div>
<x-footer />
