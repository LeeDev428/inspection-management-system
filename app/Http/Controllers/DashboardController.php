<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function adminDashboard()
    {
        // Sample KPI data - In production, fetch from database
        $data = [
            'total_active_inspections' => 124,
            'inspections_completed_this_month' => 45,
            'average_inspection_duration' => 18.67,
            'inspections_completed_change' => 5.2,
            'overdue_inspections' => 18,
            'open_non_compliance_issues' => 210,
            'nc_critical' => 5,
            'nc_major' => 80,
            'nc_minor' => 35,
            'status_scheduled' => 35,
            'status_ready' => 40,
            'status_in_progress' => 15,
            'status_for_review' => 10,
            'type_safety' => 45,
            'type_infrastructure' => 15,
            'type_equipment' => 65,
            'type_compliance' => 5,
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Show the user dashboard
     */
    public function userDashboard()
    {
        // Sample data for regular users
        $data = [
            'my_inspections' => 8,
            'pending_inspections' => 3,
            'completed_inspections' => 5,
        ];

        return view('user.dashboard', $data);
    }
}
