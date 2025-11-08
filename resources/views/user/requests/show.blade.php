@extends('layouts.user')

@section('title', 'Request Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Request #{{ $request->id }}</h2>
                <p class="text-gray-600 mt-2">Submitted on {{ $request->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <div>
                @if($request->status === 'pending')
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">⏳ Pending Review</span>
                @elseif($request->status === 'approved')
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">✓ Approved</span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">✗ Denied</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Request Information -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Request Information</h3>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="text-sm font-semibold text-gray-600">Office/Department:</label>
                <p class="text-gray-900">{{ $request->office_department ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Requested By:</label>
                <p class="text-gray-900">{{ $request->requested_by ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="text-sm font-semibold text-gray-600">Requesting Officer:</label>
                <p class="text-gray-900">{{ $request->name_of_requesting_officer ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Date/Time Requested:</label>
                <p class="text-gray-900">{{ $request->date_time_requested ? $request->date_time_requested->format('M d, Y h:i A') : 'N/A' }}</p>
            </div>
        </div>

        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">Purpose:</label>
            <p class="text-gray-900 mt-1">{{ $request->purpose ?? 'N/A' }}</p>
        </div>

        @if($request->participants)
            <div>
                <label class="text-sm font-semibold text-gray-600">Participants:</label>
                <p class="text-gray-900 mt-1">{{ $request->participants }}</p>
            </div>
        @endif
    </div>

    <!-- Request Types -->
    @if($request->operation_position || $request->ucss_purchases || $request->post_repair_water_material || $request->janitorial_services)
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Request Types</h3>
            <div class="grid grid-cols-2 gap-3">
                @if($request->operation_position)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <label class="text-sm text-gray-700">Operation Position</label>
                    </div>
                @endif
                @if($request->ucss_purchases)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <label class="text-sm text-gray-700">UCSS Purchases</label>
                    </div>
                @endif
                @if($request->post_repair_water_material)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <label class="text-sm text-gray-700">Post-Repair/Water Material</label>
                    </div>
                @endif
                @if($request->janitorial_services)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <label class="text-sm text-gray-700">Janitorial Services</label>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Uploaded Document -->
    @if($request->file_path)
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Uploaded Document</h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <a href="{{ Storage::url($request->file_path) }}" target="_blank" class="text-maroon hover:underline font-medium">
                    View Uploaded Document
                </a>
            </div>
        </div>
    @endif

    <!-- Review Status -->
    @if($request->status !== 'pending')
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Review Details</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-600">Status:</span>
                    <span class="text-gray-900 font-medium">{{ ucfirst($request->status) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-600">Reviewed By:</span>
                    <span class="text-gray-900">{{ $request->reviewer ? $request->reviewer->name : 'N/A' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-600">Reviewed At:</span>
                    <span class="text-gray-900">{{ $request->reviewed_at ? $request->reviewed_at->format('M d, Y h:i A') : 'N/A' }}</span>
                </div>
                @if($request->admin_remarks)
                    <div class="border-t pt-3 mt-3">
                        <label class="text-sm font-semibold text-gray-600 block mb-2">Admin Remarks:</label>
                        <div class="{{ $request->status === 'denied' ? 'bg-red-50 border-l-4 border-red-500' : 'bg-green-50 border-l-4 border-green-500' }} p-4 rounded">
                            <p class="text-sm text-gray-800">{{ $request->admin_remarks }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="flex justify-between">
        <a href="{{ route('user.requests.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
            ← Back to My Requests
        </a>
        @if($request->status === 'pending')
            <span class="text-sm text-gray-600 italic">Waiting for admin review...</span>
        @endif
    </div>
</div>
@endsection
