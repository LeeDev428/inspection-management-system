@extends('layouts.user')

@section('title', 'My Inspection Requests')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">My Inspection Requests</h2>
        <p class="text-gray-600 mt-2">View and manage all your inspection requests</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('user.requests.create') }}" class="px-6 py-3 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-medium">
            + New Request
        </a>
        <a href="{{ route('user.requests.upload') }}" class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition font-medium">
            📤 Upload Document
        </a>
    </div>
</div>

@if($requests->count() > 0)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office/Dept</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($requests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $request->office_department ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ Str::limit($request->purpose, 50) ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            @if($request->file_path)
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Uploaded</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Form</span>
                            @endif
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
                            <a href="{{ route('user.requests.show', $request) }}" class="text-maroon hover:text-maroon-dark">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $requests->links() }}
    </div>
@else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No requests yet</h3>
        <p class="mt-2 text-sm text-gray-500">Get started by creating your first inspection request.</p>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('user.requests.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-maroon hover:bg-maroon-light">
                Create New Request
            </a>
            <a href="{{ route('user.requests.upload') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                Upload Document
            </a>
        </div>
    </div>
@endif
@endsection
