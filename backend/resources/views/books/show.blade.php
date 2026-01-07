<x-header />
<div class="page-header">
    <h1 class="page-title">本の詳細</h1>
    <a class="btn btn-return" href="/books">本を追加</a>
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
        <div class="card quick-action">
            <p class="column-head">クイックアクション</p>
            <ul class="action-bnt-list">
                <li><a class="qa-btn qa-btn--edit" href="/books/{{ $book->id }}/edit">編集</a></li>
                <li>
                    <button class="qa-btn qa-btn--start" type="button" disabled>読書開始（未実装）</button>
                <li>
                    <button class="qa-btn qa-btn--finish" type="button" disabled>読了にする（未実装）</button>
                </li>
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
            <p class="">タイトル</p>
            <p class="">{{ $book->title }}</p>
            <p class="">著者</p>
            <p class="">{{ $book->author ?? '不明' }}</p>
            <div class="publish-info">
                <p class="">出版社</p>
            <p class="">{{ $book->publisher ?? '不明' }}</p>

            <p class="">出版日</p>
            <p class="">{{ $book->published_date ?? '不明' }}</p>
            </div>


            <p class="">ISBN</p>
            <p class="">{{ $book->isbn ?? '不明' }}</p>

            <p class="">ページ数</p>
            <p class="">{{ $book->page_count ?? '不明' }}</p>
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
