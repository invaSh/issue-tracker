<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Issue Tracker</title>
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Red Hat Display', sans-serif;
        }
    </style>
</head>

<body class="bg-[#15202B] text-gray-200 min-h-screen flex flex-col">

    <nav class="bg-[#192734] border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <a href="/" class="text-xl font-bold text-white">
                    Issue Tracker
                </a>

                <div class="flex space-x-6">
                    <a href="{{ route('projects.index') }}" class="hover:text-white text-gray-400">Projects</a>
                    <a href="{{ route('issues.index') }}" class="hover:text-white text-gray-400">Issues</a>
                    <a href="{{ route('tags.index') }}" class="hover:text-white text-gray-400">Tags</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
        @yield('content')
    </main>

</body>

</html>
