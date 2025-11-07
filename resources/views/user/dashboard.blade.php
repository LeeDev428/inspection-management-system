<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - PUP Inspection Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-maroon-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center">
                        <span class="text-maroon-800 font-bold text-xl">PUP</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">PUP Inspection Management Office</h1>
                        <p class="text-sm text-gray-200">My Dashboard</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-300">User</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-maroon-600 rounded-lg hover:bg-maroon-700 transition text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Welcome Message -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-600">Here's an overview of your inspection activities.</p>
        </div>

        <!-- My Inspections Overview -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6">My Inspections</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total My Inspections -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">TOTAL INSPECTIONS</p>
                            <p class="text-4xl font-bold text-gray-900">{{ $my_inspections }}</p>
                        </div>
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Inspections -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">PENDING</p>
                            <p class="text-4xl font-bold text-yellow-600">{{ $pending_inspections }}</p>
                        </div>
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Inspections -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">COMPLETED</p>
                            <p class="text-4xl font-bold text-green-600">{{ $completed_inspections }}</p>
                        </div>
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Inspections Table -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Recent Inspections</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Inspection Type</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Location</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-900">#001</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Safety</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Building A</td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">Nov 5, 2025</td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-900">#002</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Equipment</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Building B</td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">Nov 8, 2025</td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-900">#003</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Infrastructure</td>
                            <td class="px-4 py-4 text-sm text-gray-900">Gym</td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">In Progress</span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">Nov 7, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="px-6 py-4 bg-maroon-800 text-white rounded-lg hover:bg-maroon-700 transition font-semibold flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>New Inspection</span>
                </button>
                <button class="px-6 py-4 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>View Reports</span>
                </button>
            </div>
        </div>
    </main>

    <style>
        .bg-maroon-600 { background-color: #800000; }
        .bg-maroon-700 { background-color: #660000; }
        .bg-maroon-800 { background-color: #4d0000; }
        .text-maroon-800 { color: #4d0000; }
        .hover\:bg-maroon-700:hover { background-color: #660000; }
    </style>
</body>
</html>
