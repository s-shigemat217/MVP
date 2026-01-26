@if(session('message'))
    <div class="p-2.5 mt-4 mb-4 bg-teal-50 border border-teal-300 text-teal-800 rounded">
        <p class="text-xl font-bold">{{ session('message') }}</p>
    </div>
@endif
