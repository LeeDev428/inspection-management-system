@extends('layouts.admin')

@section('title', 'Pending Inspection Requests')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Pending Inspection Requests</h2>
    <p class="text-gray-600 mt-2">Review and approve/deny pending inspection requests</p>
</div>

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
@endif

<!-- Search and Filter Component (status filter hidden since this page is pending only) -->
@include('components.search-filter', ['action' => route('admin.requests.pending')])

@if($requests->count() > 0)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office/Dept</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Requested</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($requests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $request->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $request->user->name }}
                            <br>
                            <span class="text-xs text-gray-500">{{ $request->user->email }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $request->office_department ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $request->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            @if($request->file_path)
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">📤 Upload</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">📝 Form</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.requests.show', $request) }}" class="text-maroon hover:text-maroon-dark">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Component -->
    <div class="mt-6">
        @include('components.pagination', ['paginator' => $requests])
    </div>
@else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No pending requests</h3>
        <p class="mt-2 text-sm text-gray-500">All inspection requests have been reviewed.</p>
    </div>
@endif
@endsection
