@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}!</h2>
    <p class="text-gray-600 mt-2">Here's an overview of your inspection requests</p>
</div>

<!-- Overview Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Requests</p>
                <p class="text-4xl font-bold text-gray-900">{{ $total_requests }}</p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Pending Approval</p>
                <p class="text-4xl font-bold text-yellow-600">{{ $pending_requests }}</p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Approved</p>
                <p class="text-4xl font-bold text-green-600">{{ $approved_requests }}</p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Requests -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-800">Recent Requests</h3>
        <a href="{{ route('user.requests.index') }}" class="text-maroon hover:underline text-sm">View All</a>
    </div>

    @if($recent_requests->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Date</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Office/Department</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Purpose</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_requests as $request)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $request->office_department }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ Str::limit($request->purpose, 50) }}</td>
                            <td class="py-3 px-4 text-sm">
                                @if($request->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Approved</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Denied</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm">
                                <a href="{{ route('user.requests.show', $request) }}" class="text-maroon hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="mt-4 text-gray-600">No inspection requests yet</p>
            <div class="mt-6">
                <a href="{{ route('user.requests.create') }}" class="inline-block px-6 py-3 bg-maroon text-white rounded-lg hover:bg-maroon-light transition">
                    Create Your First Request
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('user.requests.create') }}" class="bg-maroon text-white p-6 rounded-xl shadow-lg hover:bg-maroon-light transition">
        <div class="flex items-center">
            <svg class="w-12 h-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <div>
                <h4 class="text-lg font-bold">Create New Request</h4>
                <p class="text-sm text-gray-200">Fill out inspection request form</p>
            </div>
        </div>
    </a>

    <a href="{{ route('user.requests.upload') }}" class="bg-gray-700 text-white p-6 rounded-xl shadow-lg hover:bg-gray-800 transition">
        <div class="flex items-center">
            <svg class="w-12 h-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <div>
                <h4 class="text-lg font-bold">Upload Document</h4>
                <p class="text-sm text-gray-200">Upload scanned hardcopy form</p>
            </div>
        </div>
    </a>
</div>
@endsection
