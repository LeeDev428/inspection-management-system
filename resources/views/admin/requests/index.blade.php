@extends('layouts.admin')

@section('title', 'All Inspection Requests')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">All Inspection Requests</h2>
    <p class="text-gray-600 mt-2">View and manage all inspection requests in the system</p>
</div>

<!-- Search and Filter Component -->
@include('components.search-filter', ['action' => route('admin.requests.index')])

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <p class="text-sm text-gray-600 mb-1">Total Requests</p>
        <p class="text-4xl font-bold text-gray-900">{{ $requests->total() }}</p>
    </div>
    <div class="bg-yellow-50 p-6 rounded-xl shadow-lg">
        <p class="text-sm text-gray-600 mb-1">Pending</p>
        <p class="text-4xl font-bold text-yellow-700">{{ $requests->where('status', 'pending')->count() }}</p>
    </div>
    <div class="bg-green-50 p-6 rounded-xl shadow-lg">
        <p class="text-sm text-gray-600 mb-1">Approved</p>
        <p class="text-4xl font-bold text-green-700">{{ $requests->where('status', 'approved')->count() }}</p>
    </div>
    <div class="bg-red-50 p-6 rounded-xl shadow-lg">
        <p class="text-sm text-gray-600 mb-1">Denied</p>
        <p class="text-4xl font-bold text-red-700">{{ $requests->where('status', 'denied')->count() }}</p>
    </div>
</div>

@if($requests->count() > 0)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office/Dept</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $request->office_department ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($request->status === 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($request->status === 'approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Denied
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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
        <p class="text-gray-600">No inspection requests found.</p>
    </div>
@endif
@endsection
