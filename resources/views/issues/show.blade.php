
@extends('layout.layout')

@section('title', 'Issue Detail')

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <div class="flex justify-between mb-3 border-b border-gray-600 pb-3">
            <h1 class="text-2xl font-bold">{{ $issue->title }}</h1>
            <div class="flex items-center justify-center gap-2">
                <a href="{{ route('issues.edit', $issue->id) }}"
                    class="flex items-center rounded text-gray-200 hover:text-gray-400 transition-all ease-in duration-100 text-sm cursor-pointer ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-notebook-pen-icon lucide-notebook-pen">
                        <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                        <path d="M2 6h4" />
                        <path d="M2 10h4" />
                        <path d="M2 14h4" />
                        <path d="M2 18h4" />
                        <path
                            d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                    </svg>
                    <span class="pl-1">Edit</span>
                </a>

                <form action="{{ route('issues.destroy', $issue->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center cursor-pointer text-red-600 hover:text-red-300 transition-all ease-in duration-100 rounded text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <p class="mb-2"><strong>Project:</strong> {{ $issue->project->name ?? '-' }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
        <p class="mb-2"><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
        <p class="mb-2"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}</p>
        <p class="mb-4"><strong>Description:</strong> {{ $issue->description ?? '-' }}</p>

        <div class="mb-4">
            <h2 class="font-bold text-lg mb-2">Tags</h2>
            <div class="flex flex-wrap gap-2">
                @if ($issue->tags->isEmpty())
                    <span class="text-gray-400 text-xs">No tags assigned</span>
                @else
                    @foreach ($issue->tags as $tag)
                        <span class="px-2 py-1 bg-blue-600 rounded-lg text-xs">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div>
            <h2 class="font-bold text-lg mb-2">Comments</h2>
            <ul class="space-y-2">
                @if ($issue->comments->isEmpty())
                    <span class="text-gray-400 text-xs">No comments assigned</span>
                @else
                    @foreach ($issue->comments ?? [] as $comment)
                        <li class="bg-gray-700 rounded-lg p-2">{{ $comment->content }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection
