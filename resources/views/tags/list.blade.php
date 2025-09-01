@extends('layout.layout')

@section('title', 'Tags')

@section('content')
    @if (session('success'))
        <div
            class="max-w-2xl mx-auto mb-6 px-4 py-3 rounded-lg bg-green-600 text-white text-sm font-medium
        flex items-center justify-between transition-all duration-300 ease-in-out">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()"
                class="ml-4 text-white hover:text-gray-200 transition-colors">&times;</button>
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <div class="flex justify-between mb-5">
            <h3 class="text-gray-400">Tags</h3>
            <a href="{{ route('tags.create') }}"
                class="rounded-2xl transition-all duration-300 ease-in-out px-2.5 py-1 text-xs bg-gray-600 hover:bg-gray-500 text-white flex gap-1 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Create Tag
            </a>
        </div>

        @if ($tags->isEmpty())
            <p class="text-gray-400">No tags found. Add a new one to get started!</p>
        @else
            <div class="flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                    <div class="flex items-center space-x-2 px-3 py-1 rounded-full text-sm font-medium hover:bg-gray-600"
                        style="background-color: {{ $tag->color ?? '#374151' }}">
                        <span>{{ $tag->name }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
