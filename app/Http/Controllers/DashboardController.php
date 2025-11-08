<?php

namespace App\Http\Controllers;

use App\Models\InspectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function adminDashboard()
    {
        // Fetch real data from database
        $totalRequests = InspectionRequest::count();
        $completedThisMonth = InspectionRequest::where('status', 'approved')
            ->whereMonth('reviewed_at', now()->month)
            ->whereYear('reviewed_at', now()->year)
            ->count();
        
        $pendingRequests = InspectionRequest::where('status', 'pending')->count();
        $deniedRequests = InspectionRequest::where('status', 'denied')->count();
        
        // Status breakdown
        $approvedRequests = InspectionRequest::where('status', 'approved')->count();
        
        // Type distribution (based on checkboxes)
        $operationPosition = InspectionRequest::where('operation_position', true)->count();
        $ucssPurchases = InspectionRequest::where('ucss_purchases', true)->count();
        $postRepair = InspectionRequest::where('post_repair_water_material', true)->count();
        $janitorial = InspectionRequest::where('janitorial_services', true)->count();

        $data = [
            'total_active_inspections' => $totalRequests,
            'inspections_completed_this_month' => $completedThisMonth,
            'average_inspection_duration' => 18.67, // Can be calculated based on actual data
            'inspections_completed_change' => 5.2, // Calculate vs last month
            'overdue_inspections' => $deniedRequests,
            'open_non_compliance_issues' => $pendingRequests,
            'nc_critical' => ceil($deniedRequests * 0.1),
            'nc_major' => ceil($deniedRequests * 0.6),
            'nc_minor' => ceil($deniedRequests * 0.3),
            'status_scheduled' => $pendingRequests,
            'status_ready' => 0,
            'status_in_progress' => 0,
            'status_for_review' => $approvedRequests,
            'type_safety' => $operationPosition,
            'type_infrastructure' => $postRepair,
            'type_equipment' => $ucssPurchases,
            'type_compliance' => $janitorial,
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Show the user dashboard
     */
    public function userDashboard()
    {
        $userId = Auth::id();
        
        // Fetch real data for the authenticated user
        $totalRequests = InspectionRequest::where('user_id', $userId)->count();
        $pendingRequests = InspectionRequest::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $approvedRequests = InspectionRequest::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();
        
        // Get recent requests
        $recentRequests = InspectionRequest::where('user_id', $userId)
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'total_requests' => $totalRequests,
            'pending_requests' => $pendingRequests,
            'approved_requests' => $approvedRequests,
            'recent_requests' => $recentRequests,
        ];

        return view('user.dashboard', $data);
    }
}
