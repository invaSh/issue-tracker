@extends('layout.layout')

@section('title', 'Edit Issue')

@section('content')
    <div class="max-w-2xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Issue</h1>

        <form action="{{ route('issues.update', $issue->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $issue->title) }}"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="6"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $issue->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-300 mb-1">Project</label>
                <select name="project_id" id="project_id"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $issue->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="open" {{ $issue->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $issue->status == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="closed" {{ $issue->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-300 mb-1">Priority</label>
                    <select name="priority" id="priority"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="low" {{ $issue->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $issue->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $issue->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-300 mb-1">Due Date</label>
                    <input type="date" name="due_date" id="due_date"
                        value="{{ old('due_date', $issue->due_date ? \Carbon\Carbon::parse($issue->due_date)->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    @error('due_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center px-4 py-2 rounded bg-gray-500 text-gray-200 hover:bg-gray-600 transition-all ease-in duration-100 text-sm cursor-pointer ">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
