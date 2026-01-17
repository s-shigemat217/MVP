<x-header />
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">蔵書一覧</h1>
    <a href="/books/form/" class="inline-flex items-center w-full px-5 py-3 mb-3 mr-1 text-base font-semibold text-white no-underline align-middle bg-blue-600 border border-transparent border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700">
        本を追加<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>

@if(session('message'))
  <div class="message">
    <p class="text-xl font-bold text-green-800">{{ session('message') }}</p>
  </div>
@endif

<ul class="mt-16 flex gap-6" style="list-style-type: none; padding: 0;">
    @forelse($books as $book)
        <li class="mb-4">
            <a href="/books/{{ $book->id }}">
                <div>
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
