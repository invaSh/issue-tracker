@extends('layout.layout')

@section('title', 'Create Issue')

@section('content')
    <div class="max-w-2xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Create Issue</h1>

        <form action="{{ route('issues.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Title <span
                        class="text-red-400">*</span></label>
                <input type="text" name="title" id="title"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter issue title">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description <span
                        class="text-red-400">*</span></label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Brief description of the issue"></textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-300 mb-1">Project <span
                        class="text-red-400">*</span></label>
                <select name="project_id" id="project_id"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status <span
                            class="text-red-400">*</span></label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected hidden>Select status</option>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-300 mb-1">Priority <span
                            class="text-red-400">*</span></label>
                    <select name="priority" id="priority"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected hidden>Select priority</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                    @error('priority')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-300 mb-1">Due Date</label>
                    <input type="date" name="due_date" id="due_date"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('due_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="rounded transition-all duration-300 ease-in-out px-3 py-1.5 text-sm bg-gray-600 hover:bg-gray-500 text-white flex gap-1 items-center">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
