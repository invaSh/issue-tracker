@extends('layout.layout')

@section('title', 'Project Profile')

@section('content')
    <div class="flex flex-col justify-center items-center gap-3">
        <h1 class="text-center text-xl text-gray-300">Welcome to your Issue Tracker!</h1>
        <h3 class="text-center text-gray-400 text-sm">Click on create project to get started!</h3>
        <a href="{{ route('projects.create') }}"
            class="rounded-2xl transition-all duration-300 mx-auto ease-in-out px-2.5 py-1 text-xs bg-gray-600 hover:bg-gray-500 text-white flex gap-1 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            Create Project
        </a>
    </div>
@endsection
