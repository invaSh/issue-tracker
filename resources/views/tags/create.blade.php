@extends('layout.layout')

@section('title', 'Create Tag')

@section('content')
    <div class="max-w-2xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Create Tag</h1>

        <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-blue-500">
                <p class="text-red-400 text-sm mt-1 error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium">Color</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-500">Create</button>
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
