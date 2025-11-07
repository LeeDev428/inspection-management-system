<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP Inspection Management Office</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-maroon { background-color: #800000; }
        .bg-maroon-dark { background-color: #660000; }
        .bg-maroon-darker { background-color: #4d0000; }
        .text-maroon { color: #800000; }
        .hover\:bg-maroon-light:hover { background-color: #990000; }
        .focus\:ring-maroon:focus { --tw-ring-color: #800000; }
        .border-maroon { border-color: #800000; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-maroon shadow-lg">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        <span class="text-maroon font-bold text-xl">PUP</span>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl">Polytechnic University of the Philippines</h1>
                        <p class="text-gray-200 text-sm">Inspection Management Office</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="px-6 py-2 text-white border-2 border-white rounded-lg hover:bg-white hover:text-maroon transition font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-maroon rounded-lg hover:bg-gray-100 transition font-medium">
                        Register
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="py-20" style="background: linear-gradient(to bottom right, #800000, #660000, #4d0000);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-extrabold mb-6 text-white">Inspection Management System</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto text-white">
                Streamline your inspection processes, track compliance, and ensure safety standards across all PUP facilities with our comprehensive management platform.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-maroon rounded-lg hover:bg-gray-100 transition font-bold text-lg shadow-xl">
                    Get Started
                </a>
                <a href="#features" class="px-8 py-4 border-2 border-white text-white rounded-lg hover:bg-white hover:text-maroon transition font-bold text-lg">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Our Platform?</h3>
                <p class="text-xl text-gray-600">Powerful features to manage inspections efficiently</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-maroon rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Real-time Tracking</h4>
                    <p class="text-gray-600">
                        Monitor inspection progress in real-time with instant updates and notifications. Stay informed about every step of the process.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-maroon rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Comprehensive Analytics</h4>
                    <p class="text-gray-600">
                        Get detailed insights with powerful analytics and reporting tools. Make data-driven decisions to improve safety and compliance.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-maroon rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Secure & Compliant</h4>
                    <p class="text-gray-600">
                        Enterprise-grade security with role-based access control. Keep your inspection data safe and compliant with regulations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-maroon py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-5xl font-bold text-white mb-2">500+</p>
                    <p class="text-gray-200 text-lg">Inspections Completed</p>
                </div>
                <div>
                    <p class="text-5xl font-bold text-white mb-2">50+</p>
                    <p class="text-gray-200 text-lg">Active Buildings</p>
                </div>
                <div>
                    <p class="text-5xl font-bold text-white mb-2">98%</p>
                    <p class="text-gray-200 text-lg">Compliance Rate</p>
                </div>
                <div>
                    <p class="text-5xl font-bold text-white mb-2">24/7</p>
                    <p class="text-gray-200 text-lg">System Availability</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-4xl font-bold text-gray-900 mb-6">Ready to Get Started?</h3>
            <p class="text-xl text-gray-600 mb-8">
                Join PUP's comprehensive inspection management platform today and streamline your facility management processes.
            </p>
            <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-bold text-lg shadow-xl">
                Create Your Account
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-maroon rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">PUP</span>
                        </div>
                        <span class="font-bold text-lg">PUP Inspection Office</span>
                    </div>
                    <p class="text-gray-400">
                        Ensuring safety and compliance across all Polytechnic University of the Philippines facilities.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 inspection@pup.edu.ph</li>
                        <li>📞 (02) 1234-5678</li>
                        <li>📍 Sta. Mesa, Manila, Philippines</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Polytechnic University of the Philippines. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
