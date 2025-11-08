@extends('layouts.admin')

@section('title', 'Inspection Request Details')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Inspection Request #{{ $request->id }}</h2>
            <p class="text-gray-600 mt-2">Submitted by {{ $request->user->name }} on {{ $request->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div>
            @if($request->status === 'pending')
                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Pending Review</span>
            @elseif($request->status === 'approved')
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">✓ Approved</span>
            @else
                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">✗ Denied</span>
            @endif
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Request Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
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
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Request Types</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->operation_position ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Operation Position</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->ucss_purchases ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">UCSS Purchases</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->post_repair_water_material ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Post-Repair/Water Material</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->janitorial_services ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Janitorial Services</label>
                </div>
            </div>
        </div>

        <!-- Documentary Requirements -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Documentary Requirements</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->sales_invoice_official_receipt ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Sales Invoice/Official Receipt</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->approved_purchase_request ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Approved Purchase Request</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->invoice_delivery_receipt_materials ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Invoice Delivery Receipt</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->special_order_designation ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Special Order/Designation</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->request_for_post_repair_inspection ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Post-Repair Inspection</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->inventory_custodian_slip ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Inventory Custodian Slip</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->property_acknowledge_receipt ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">Property Acknowledge Receipt</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" {{ $request->cnas ? 'checked' : '' }} disabled class="h-4 w-4 text-maroon rounded">
                    <label class="ml-2 text-sm text-gray-700">CNAS</label>
                </div>
                @if($request->others_document)
                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-600">Others:</label>
                        <p class="text-gray-900">{{ $request->others_document_text }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Uploaded File -->
        @if($request->file_path)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Uploaded Document</h3>
                <div class="border rounded-lg p-4">
                    <a href="{{ Storage::url($request->file_path) }}" target="_blank" class="text-maroon hover:underline flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                        </svg>
                        View Uploaded Document
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar Actions -->
    <div class="space-y-6">
        <!-- User Info -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Submitted By</h3>
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($request->user->name, 0, 1)) }}
                </div>
                <div class="ml-3">
                    <p class="font-semibold text-gray-900">{{ $request->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $request->user->email }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Role: {{ ucfirst($request->user->role) }}</p>
        </div>

        <!-- Approval Actions -->
        @if($request->status === 'pending')
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                
                <!-- Approve Form -->
                <form action="{{ route('admin.requests.approve', $request) }}" method="POST" class="mb-4">
                    @csrf
                    <textarea name="admin_remarks" rows="3" placeholder="Add remarks (optional)" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-3 text-sm"></textarea>
                    <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                        ✓ Approve Request
                    </button>
                </form>

                <!-- Deny Form -->
                <form action="{{ route('admin.requests.deny', $request) }}" method="POST">
                    @csrf
                    <textarea name="admin_remarks" rows="3" placeholder="Reason for denial (required)" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-3 text-sm"></textarea>
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        ✗ Deny Request
                    </button>
                </form>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Review Details</h3>
                <div class="space-y-2">
                    <div>
                        <label class="text-xs font-semibold text-gray-600">Status:</label>
                        <p class="text-gray-900">{{ ucfirst($request->status) }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600">Reviewed By:</label>
                        <p class="text-gray-900">{{ $request->reviewer ? $request->reviewer->name : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600">Reviewed At:</label>
                        <p class="text-gray-900">{{ $request->reviewed_at ? $request->reviewed_at->format('M d, Y h:i A') : 'N/A' }}</p>
                    </div>
                    @if($request->admin_remarks)
                        <div>
                            <label class="text-xs font-semibold text-gray-600">Admin Remarks:</label>
                            <p class="text-gray-900 text-sm mt-1">{{ $request->admin_remarks }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <a href="{{ route('admin.requests.pending') }}" class="block text-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
            ← Back to List
        </a>
    </div>
</div>
@endsection
