<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PUP Inspection Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-maroon { background-color: #800000; }
        .bg-maroon-dark { background-color: #660000; }
        .text-maroon { color: #800000; }
        .hover\:bg-maroon-light:hover { background-color: #990000; }
        .focus\:ring-maroon:focus { --tw-ring-color: #800000; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div class="mx-auto w-24 h-24 bg-maroon rounded-full flex items-center justify-center mb-4">
                    <span class="text-white font-bold text-4xl">PUP</span>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-sm text-gray-600">Inspection Management Office</p>
            </div>

            <form class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-lg" method="POST" action="{{ route('login') }}">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <ul class="list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-maroon focus:border-transparent"
                               placeholder="Enter your email" value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-maroon focus:border-transparent"
                               placeholder="Enter your password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-maroon hover:text-maroon-dark">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-maroon hover:bg-maroon-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-maroon transition">
                        Sign in
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-maroon hover:text-maroon-dark">Register here</a>
                    </p>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-maroon">← Back to home</a>
            </div>
        </div>
    </div>
</body>
</html>
