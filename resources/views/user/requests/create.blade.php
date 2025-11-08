@extends('layouts.user')

@section('title', 'Create Inspection Request')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Request Form for Inspection</h2>
        <p class="text-gray-600 mt-2">Fill out the form below to submit your inspection request</p>
    </div>

    <form action="{{ route('user.requests.store') }}" method="POST" class="bg-white rounded-xl shadow-lg p-8">
        @csrf

        <!-- Request Type Checkboxes -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Request Type (✓ or NA)</label>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="operation_position" id="operation_position" value="1" class="h-5 w-5 text-maroon border-gray-300 rounded focus:ring-maroon">
                    <label for="operation_position" class="ml-3 text-sm text-gray-700">Operation Position (Craft Adviser, Internal Funded, External Funded)</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="post_repair_water_material" id="post_repair_water_material" value="1" class="h-5 w-5 text-maroon border-gray-300 rounded focus:ring-maroon">
                    <label for="post_repair_water_material" class="ml-3 text-sm text-gray-700">Post-Repair/Water Material</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="ucss_purchases" id="ucss_purchases" value="1" class="h-5 w-5 text-maroon border-gray-300 rounded focus:ring-maroon">
                    <label for="ucss_purchases" class="ml-3 text-sm text-gray-700">UCSS Purchases</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="janitorial_services" id="janitorial_services" value="1" class="h-5 w-5 text-maroon border-gray-300 rounded focus:ring-maroon">
                    <label for="janitorial_services" class="ml-3 text-sm text-gray-700">Janitorial Services</label>
                </div>
            </div>
        </div>

        <div class="border-t pt-6 mb-6">
            <div class="grid grid-cols-2 gap-6">
                <!-- Date and Time Requested -->
                <div>
                    <label for="date_time_requested" class="block text-sm font-semibold text-gray-700 mb-2">Date and Time Requested: <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="date_time_requested" id="date_time_requested" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                    @error('date_time_requested')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Requested By -->
                <div>
                    <label for="requested_by" class="block text-sm font-semibold text-gray-700 mb-2">Requested by: <span class="text-red-500">*</span></label>
                    <input type="text" name="requested_by" id="requested_by" required value="{{ old('requested_by') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                           placeholder="Enter name">
                    @error('requested_by')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <!-- Office/Department -->
            <div>
                <label for="office_department" class="block text-sm font-semibold text-gray-700 mb-2">Office/Department: <span class="text-red-500">*</span></label>
                <input type="text" name="office_department" id="office_department" required value="{{ old('office_department') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                       placeholder="Enter office or department">
                @error('office_department')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name of Requesting Officer -->
            <div>
                <label for="name_of_requesting_officer" class="block text-sm font-semibold text-gray-700 mb-2">Name of Requesting Officer: <span class="text-red-500">*</span></label>
                <input type="text" name="name_of_requesting_officer" id="name_of_requesting_officer" required value="{{ old('name_of_requesting_officer') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                       placeholder="Enter officer name">
                @error('name_of_requesting_officer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Purpose -->
        <div class="mb-6">
            <label for="purpose" class="block text-sm font-semibold text-gray-700 mb-2">Purpose: <span class="text-red-500">*</span></label>
            <textarea name="purpose" id="purpose" rows="3" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                      placeholder="Enter the purpose of inspection">{{ old('purpose') }}</textarea>
            @error('purpose')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Participants -->
        <div class="mb-6">
            <label for="participants" class="block text-sm font-semibold text-gray-700 mb-2">Participants:</label>
            <textarea name="participants" id="participants" rows="2"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                      placeholder="List all participants (optional)">{{ old('participants') }}</textarea>
        </div>

        <!-- Documentary Requirements -->
        <div class="border-t pt-6 mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Documentary Requirements (***to be filled in by Inspection Staff)</label>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="sales_invoice_official_receipt" id="sales_invoice_official_receipt" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="sales_invoice_official_receipt" class="ml-2 text-sm text-gray-700">☐ Sales Invoice/Official Receipt</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="special_order_designation" id="special_order_designation" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="special_order_designation" class="ml-2 text-sm text-gray-700">☐ Special Order / Designation</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="approved_purchase_request" id="approved_purchase_request" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="approved_purchase_request" class="ml-2 text-sm text-gray-700">☐ Approved Purchase Request</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="request_for_post_repair_inspection" id="request_for_post_repair_inspection" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="request_for_post_repair_inspection" class="ml-2 text-sm text-gray-700">☐ Request for Post-Repair and Inspection</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="invoice_delivery_receipt_materials" id="invoice_delivery_receipt_materials" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="invoice_delivery_receipt_materials" class="ml-2 text-sm text-gray-700">☐ Invoice Delivery Receipt of materials</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="inventory_custodian_slip" id="inventory_custodian_slip" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="inventory_custodian_slip" class="ml-2 text-sm text-gray-700">☐ Inventory Custodian Slip</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="property_acknowledge_receipt" id="property_acknowledge_receipt" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="property_acknowledge_receipt" class="ml-2 text-sm text-gray-700">☐ Property Acknowledge Receipt</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="cnas" id="cnas" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="cnas" class="ml-2 text-sm text-gray-700">☐ CNAS</label>
                </div>
                <div class="col-span-2 flex items-center">
                    <input type="checkbox" name="others_document" id="others_document" value="1" class="h-4 w-4 text-maroon border-gray-300 rounded">
                    <label for="others_document" class="ml-2 text-sm text-gray-700">☐ Others:</label>
                    <input type="text" name="others_document_text" id="others_document_text" placeholder="Specify others"
                           class="ml-2 flex-1 px-3 py-1 border border-gray-300 rounded text-sm">
                </div>
            </div>
        </div>

        <!-- Remarks Section -->
        <div class="border-t pt-6 mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Remarks (Optional - JSON format for complex data)</label>
            <p class="text-xs text-gray-500 mb-2">Example: [{"item":"Sample Item","document_in":"2025-01-15","document_out":"2025-01-20","remarks":"Sample remark","status":"C"}]</p>
            <textarea name="remarks_data" id="remarks_data" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent font-mono text-sm"
                      placeholder='[{"item":"","document_in":"","document_out":"","remarks":"","status":"C or NC"}]'>{{ old('remarks_data') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Leave empty if not needed. Admin can add remarks after review.</p>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-medium">
                Submit Request
            </button>
        </div>
    </form>
</div>
@endsection
