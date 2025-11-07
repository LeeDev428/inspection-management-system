<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PUP Inspection Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <h1 class="text-xl font-bold">PUP Inspection Management Office Dashboard</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-300">Administrator</p>
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
