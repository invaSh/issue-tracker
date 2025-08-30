@extends('layout.layout')

@section('title', 'Create Project')

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
        <h1 class="text-2xl font-bold mb-6">Create Project</h1>

        <form action="{{ route('projects.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Project Name <span
                        class="text-red-400">*</span></label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter project name" value="{{ old('name') }}">
                <p class="text-red-400 text-sm mt-1 error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description <span
                        class="text-red-400">*</span></label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Brief description of the project">{{ old('description') }}</textarea>
                <p class="text-red-400 text-sm mt-1 error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-300 mb-1">Start Date <span
                        class="text-red-400">*</span></label>
                <input type="date" name="start_date" id="start_date"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('start_date') }}">
                <p class="text-red-400 text-sm mt-1 error-message">
                    @error('start_date')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div>
                <label for="deadline" class="block text-sm font-medium text-gray-300 mb-1">Deadline <span
                        class="text-red-400">*</span></label>
                <input type="date" name="deadline" id="deadline"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('deadline') }}">
                <p class="text-red-400 text-sm mt-1 error-message">
                    @error('deadline')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition">
                    Create
                </button>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', () => {
                const errorMsg = input.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.textContent = '';
                }
            });
        });
    </script>
@endsection
