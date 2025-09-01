@extends('layout.layout')

@section('title', 'Issues')

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
    <div class="max-w-5xl mx-auto text-gray-100 p-6 text-sm">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-gray-400 text-lg">Issues</h3>
            <div class="flex space-x-3 justify-end text-sm">
                <a href="{{ route('issues.create') }}"
                    class="rounded-2xl transition-all duration-300 ease-in-out px-2.5 py-1 text-xs bg-gray-600 hover:bg-gray-500 text-white flex gap-1 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-plus-icon lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Create Issue
                </a>

                <form action="{{ route('issues.index') }}" method="GET" class="flex space-x-3 items-center">
                    <select name="status"
                        class="bg-gray-700 text-gray-100 border border-gray-600 rounded-2xl px-2 py-0.5 text-xs">
                        <option value="" disabled selected>Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>

                    <select name="priority"
                        class="bg-gray-700 text-gray-100 border border-gray-600 rounded-2xl px-2 py-0.5 text-xs">
                        <option value="" disabled selected>Priority</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>

                    <select name="tag"
                        class="bg-gray-700 text-gray-100 border border-gray-600 rounded-2xl px-2 py-0.5 text-xs">
                        <option value="" disabled selected>Tag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                                {{ ucfirst($tag->name) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="px-3 py-1 text-xs rounded-2xl bg-blue-600 hover:bg-blue-500 text-white transition">
                        Filter
                    </button>

                    <a href="{{ route('issues.index') }}"
                        class="px-3 py-1 text-xs rounded-2xl bg-gray-600 hover:bg-gray-500 text-white transition">
                        Reset
                    </a>
                </form>

            </div>

        </div>

        @if ($issues->isEmpty())
            <p class="text-gray-400 text-sm">No issues. Add a new issue to get started.</p>
        @else
            <table class="w-full text-left border border-gray-600 rounded overflow-hidden text-sm">
                <thead class="bg-gray-700 text-xs">
                    <tr>
                        <th class="px-3 py-2">Title</th>
                        <th class="px-3 py-2">Project</th>
                        <th class="px-3 py-2">Status</th>
                        <th class="px-3 py-2">Priority</th>
                        <th class="px-3 py-2">Due Date</th>
                        <th class="px-3 py-2">Tags</th>
                        <th class="px-3 py-2">Profile</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 text-xs">
                    @foreach ($issues as $issue)
                        <tr class="border-t border-gray-600">
                            <td class="px-3 py-2">{{ $issue->title }}</td>
                            <td class="px-3 py-2">{{ $issue->project->name ?? '-' }}</td>
                            <td class="px-3 py-2">{{ ucfirst($issue->status) }}</td>
                            <td class="px-3 py-2">{{ ucfirst($issue->priority) }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}</td>
                            <td class="px-3 py-2 space-x-1">
                                @php
                                    $tagsToShow = $issue->tags->take(2);
                                    $extraCount = $issue->tags->count() - $tagsToShow->count();
                                @endphp

                                @if ($issue->tags->isEmpty())
                                    <span class="px-2 py-1 rounded-full text-xs font-medium text-gray-200 bg-gray-700">
                                        N/A
                                    </span>
                                @else
                                    @foreach ($tagsToShow as $tag)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium text-gray-200"
                                            style="background-color: {{ $tag->color ?? '#374151' }};">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach

                                    @if ($extraCount > 0)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium text-gray-200 bg-gray-700">
                                            +{{ $extraCount }} more
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-3 py-2 space-x-1">
                                <a href="{{ route('issues.show', $issue->id) }}">
                                    <span
                                        class="px-3 py-1 cursor-pointer text-gray-300 rounded-lg text-[10px] font-medium transition-colors group-hover:text-white whitespace-nowrap group-hover:underline underline-offset-1">
                                        View Profile →
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
