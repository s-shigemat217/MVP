<x-header />
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">蔵書一覧</h1>
        <x-button href="/books/form/" class="w-full mb-3 mr-1 sm:mb-0 sm:w-auto">
            本を追加<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </x-button>
    </div>

    <x-message />

    <ul class="mt-16 grid grid-cols-5 gap-6 list-none p-0">
        @forelse($books as $book)
            <li class="border bg-white border-gray-500 rounded-lg p-4 flex flex-col gap-4">
                <a href="/books/{{ $book->id }}">
                    <div class="flex justify-center align-top">
                        @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="cover" class="w-[150px] h-[212px] object-cover">
                        @else
                        <img src="https://placehold.jp/cccccc/ffffff/150x212.png?text=No+Image" alt="no cover" class="w-[150px] h-[212px] object-cover">
                        @endif
                    </div>
                    <div class="mt-4 flex flex-col gap-1 min-h-[5.5rem]">
                        <strong class="leading-snug">{{ $book->title }}</strong>
                        <p class="text-sm">著者：{{ $book->author ?? '不明' }}</p>
                        <p class="text-sm">出版社：{{ $book->publisher ?? '不明' }}</p>
                    </div>
                </a>
            </li>
        @empty
            <li>まだ本が登録されていません。</li>
        @endforelse
    </ul>
<x-footer />
