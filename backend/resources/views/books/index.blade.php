<x-header />
<div class="page-header">
    <h1 class="page-title">蔵書一覧</h1>
    <a class="btn btn-addBook" href="/books/form">本を追加</a>
</div>
@if(session('message'))
  <div class="message">
    {{ session('message') }}
  </div>
@endif
{{-- <ul class="book-list">
    @forelse($books as $book)
        <li class="list-item" style="margin-bottom: 1em;">
            <p class="item-information">
                <strong>{{ $book->title }}</strong><br>
            著者：{{ $book->author ?? '不明' }}<br>
            出版社：{{ $book->publisher ?? '不明' }}<br>
            出版日：{{ $book->published_date ?? '不明' }}<br>
            状態：{{ $book->status }}<br>
            </p>
            <div class="img">
                @if($book->cover_image_url)
                <img src="{{ $book->cover_image_url }}" alt="cover" style="height:120px;">
                @endif
            </div>
        </li>
    @empty
        <li>まだ本が登録されていません。</li>
    @endforelse
</ul> --}}
<ul class="book-list">
    @forelse($books as $book)
        <li class="list-item" style="margin-bottom: 1em;">
            <a href="/books/{{ $book->id }}">
                <div class="img">
                    @if($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}" alt="cover">
                    @else
                    <img src="https://placehold.jp/059669/ffffff/140x200.png?text=No%20Image" alt="no cover">
                    @endif
                </div>
            </a>
        </li>
    @empty
        <li>まだ本が登録されていません。</li>
    @endforelse
</ul>
<x-footer />
