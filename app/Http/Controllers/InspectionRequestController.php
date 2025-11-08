<?php

namespace App\Http\Controllers;

use App\Models\InspectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InspectionRequestController extends Controller
{
    // User: View all their requests
    public function index()
    {
        $requests = Auth::user()->inspectionRequests()->latest()->paginate(10);
        return view('user.requests.index', compact('requests'));
    }

    // User: Show create form
    public function create()
    {
        return view('user.requests.create');
    }

    // User: Store new request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_time_requested' => 'required|date',
            'office_department' => 'required|string|max:255',
            'purpose' => 'required|string',
            'requested_by' => 'required|string|max:255',
            'name_of_requesting_officer' => 'required|string|max:255',
            'participants' => 'nullable|string',
            'others_document_text' => 'nullable|string|max:255',
            'remarks_data' => 'nullable|string',
        ]);

        // Handle checkboxes (checkboxes not checked won't be in request)
        $validated['user_id'] = Auth::id();
        $validated['operation_position'] = $request->has('operation_position');
        $validated['ucss_purchases'] = $request->has('ucss_purchases');
        $validated['post_repair_water_material'] = $request->has('post_repair_water_material');
        $validated['janitorial_services'] = $request->has('janitorial_services');
        $validated['sales_invoice_official_receipt'] = $request->has('sales_invoice_official_receipt');
        $validated['approved_purchase_request'] = $request->has('approved_purchase_request');
        $validated['invoice_delivery_receipt_materials'] = $request->has('invoice_delivery_receipt_materials');
        $validated['special_order_designation'] = $request->has('special_order_designation');
        $validated['request_for_post_repair_inspection'] = $request->has('request_for_post_repair_inspection');
        $validated['inventory_custodian_slip'] = $request->has('inventory_custodian_slip');
        $validated['property_acknowledge_receipt'] = $request->has('property_acknowledge_receipt');
        $validated['cnas'] = $request->has('cnas');
        $validated['others_document'] = $request->has('others_document');

        // Validate and parse remarks_data if provided
        if (!empty($validated['remarks_data'])) {
            $remarksJson = json_decode($validated['remarks_data'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['remarks_data'] = $remarksJson;
            } else {
                $validated['remarks_data'] = null;
            }
        } else {
            $validated['remarks_data'] = null;
        }

        InspectionRequest::create($validated);

        return redirect()->route('user.requests.index')->with('success', 'Inspection request submitted successfully!');
    }

    // User: Show upload form
    public function uploadForm()
    {
        return view('user.requests.upload');
    }

    // User: Handle file upload
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'office_department' => 'required|string|max:255',
            'purpose' => 'required|string',
        ]);

        $filePath = $request->file('file')->store('inspection-documents', 'public');

        InspectionRequest::create([
            'user_id' => Auth::id(),
            'file_path' => $filePath,
            'office_department' => $request->office_department,
            'purpose' => $request->purpose,
            'requested_by' => Auth::user()->name,
            'status' => 'pending',
        ]);

        return redirect()->route('user.requests.index')->with('success', 'Document uploaded successfully!');
    }

    // User: View single request
    public function show(InspectionRequest $request)
    {
        // Ensure user can only view their own requests
        if ($request->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('user.requests.show', compact('request'));
    }

    // Admin: View all requests
    public function adminIndex()
    {
        $requests = InspectionRequest::with('user')->latest()->paginate(15);
        return view('admin.requests.index', compact('requests'));
    }

    // Admin: View pending requests
    public function adminPending()
    {
        $requests = InspectionRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);
        return view('admin.requests.pending', compact('requests'));
    }

    // Admin: Show single request
    public function adminShow(InspectionRequest $request)
    {
        $request->load('user');
        return view('admin.requests.show', compact('request'));
    }

    // Admin: Approve request
    public function approve(Request $request, InspectionRequest $inspectionRequest)
    {
        $request->validate([
            'admin_remarks' => 'nullable|string',
        ]);

        $inspectionRequest->update([
            'status' => 'approved',
            'admin_remarks' => $request->admin_remarks,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Request approved successfully!');
    }

    // Admin: Deny request
    public function deny(Request $request, InspectionRequest $inspectionRequest)
    {
        $request->validate([
            'admin_remarks' => 'required|string',
        ]);

        $inspectionRequest->update([
            'status' => 'denied',
            'admin_remarks' => $request->admin_remarks,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Request denied!');
    }
}
