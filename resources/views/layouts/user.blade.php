<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - PUP Inspection Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-maroon { background-color: #800000; }
        .bg-maroon-dark { background-color: #660000; }
        .text-maroon { color: #800000; }
        .hover\:bg-maroon-light:hover { background-color: #990000; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-maroon text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center">
                        <span class="text-maroon font-bold text-xl">PUP</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">PUP Inspection Management Office</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-300">User</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-maroon-dark rounded-lg hover:bg-maroon-light transition text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content with Sidebar -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg min-h-screen">
            <nav class="py-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('user.requests.index') }}" class="flex items-center justify-between px-6 py-3 {{ request()->routeIs('user.requests.index') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        My Requests
                    </div>
                    @php
                        $reviewedCount = auth()->user()->inspectionRequests()
                            ->whereIn('status', ['approved', 'denied'])
                            ->count();
                    @endphp
                    @if($reviewedCount > 0)
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{ $reviewedCount }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('user.requests.create') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('user.requests.create') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Request
                </a>
                <a href="{{ route('user.requests.upload') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('user.requests.upload') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Upload Document
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('profile.edit') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mb-6">
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
