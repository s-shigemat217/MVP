<x-header />
<div class="page-header flex items-center justify-between">
    <h1 class="page-title">本を登録</h1>
    <a class="btn btn-return" href="/books">一覧を見る</a>
</div>
@if(session('message'))
    <div class="message">
        <p class="text-xl font-bold text-green-800">{{ session('message') }}</p>
    </div>
@endif

<form method="GET" action="/books/search">
    <div class="form-group">
        <label for="q">本のタイトルを入力</label>
        <input type="text" name="q" id="q" placeholder="本のタイトルを入力" required>
    </div>
    <button class="btn btn-search" type="submit">検索</button>
</form>
@if(!empty($books))
<h2>検索結果：「{{ $q }}」</h2>

<ul class="mt-16" style="list-style-type: none; padding: 0;">
    @foreach($books as $book)
        @php
            $info = $book['volumeInfo'] ?? [];
        @endphp

        <li style="margin-bottom: 1em;">
            @php
                $thumbnail = $info['imageLinks']['thumbnail'] ?? null;
                if ($thumbnail) {
                    $thumbnail = str_replace('http://', 'https://', $thumbnail);
                }
            @endphp
            <div class="result-image">
                @if($thumbnail)
                    <img src="{{ $thumbnail }}" alt="cover">
                @else
                    <img src="https://placehold.jp/cccccc/ffffff/100x140.png?text=No+Image" alt="no cover">
                @endif
            </div>

            <strong>{{ $info['title'] ?? 'タイトル不明' }}</strong><br>
            著者：{{ $info['authors'][0] ?? '不明' }}<br>
            出版社：{{ $info['publisher'] ?? '不明' }}<br>

            <form method="POST" action="/books/from-api">
                @csrf

                <input type="hidden" name="title" value="{{ $info['title'] ?? '' }}">
                <input type="hidden" name="author" value="{{ $info['authors'][0] ?? '' }}">
                <input type="hidden" name="publisher" value="{{ $info['publisher'] ?? '' }}">
                <input type="hidden" name="published_date" value="{{ $info['publishedDate'] ?? '' }}">
                <input type="hidden" name="cover_image_url" value="{{ $info['imageLinks']['thumbnail'] ?? '' }}">

                <input type="hidden" name="source" value="google_books">
                <input type="hidden" name="source_id" value="{{ $book['id'] }}">

                <button type="submit" class="btn btn-primary">登録</button>

            </form>
        </li>
    @endforeach
</ul>
@endif
<x-footer />
