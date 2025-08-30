@extends('layout.layout')

@section('title', 'Projects')


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

    <div class="max-w-4xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        @if ($projects->isEmpty())
            <p class="text-gray-400">No projects found. Add a new project to get started!</p>
        @else
            <ul class="space-y-4">
                @foreach ($projects as $project)
                    <a href="{{ route('projects.show', $project->id) }}"
                        class="p-4 bg-gray-700 rounded-lg group flex justify-between items-center
    transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-101 hover:bg-gray-600 shadow-md hover:shadow-lg">

                        <div class="flex-1 pr-4 overflow-hidden">
                            <h2 class="font-semibold text-lg truncate group-hover:text-white transition-colors">
                                {{ $project->name }}</h2>
                            <p class="text-gray-400 text-sm line-clamp-2 group-hover:text-gray-100 transition-colors">
                                {{ $project->description }}</p>
                            <p class="text-gray-500 text-xs group-hover:text-gray-300 transition-colors">
                                Start: {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }} |
                                Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}
                            </p>
                        </div>

                        <span
                            class="flex-shrink-0 px-4 py-2 cursor-pointer text-gray-300 rounded-lg text-xs font-medium transition-colors group-hover:text-white whitespace-nowrap group-hover:underline underline-offset-2">
                            View Profile →
                        </span>
                    </a>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
