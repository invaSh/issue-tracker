@extends('layout.layout')

@section('title', 'Edit Project')

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6 text-left">
        <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm text-gray-300" for="name">Project Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}"
                    class="p-2 rounded w-full text-gray-300 bg-gray-100/10 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-300" for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date"
                    value="{{ old('start_date', \Carbon\Carbon::parse($project->start_date)->format('Y-m-d')) }}"
                    class="p-2 rounded w-full text-gray-300 bg-gray-100/10 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('start_date')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-300" for="deadline">Deadline</label>
                <input type="date" id="deadline" name="deadline"
                    value="{{ old('deadline', \Carbon\Carbon::parse($project->deadline)->format('Y-m-d')) }}"
                    class="p-2 rounded w-full text-gray-300 bg-gray-100/10 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('deadline')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="scrollbar-hide">
                <label class="text-sm text-gray-300" for="description">Description</label>
                <textarea id="description" name="description"
                    class="p-2 rounded w-full text-gray-300  bg-gray-100/10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="6">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="flex items-center px-4 py-2 rounded text-gray-200 hover:text-gray-400 transition-all ease-in duration-100 text-sm cursor-pointer ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-save-icon lucide-save">
                    <path
                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                    <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                </svg>
                <span class="pl-1">Save</span>
            </button>
        </form>
    </div>
@endsection
