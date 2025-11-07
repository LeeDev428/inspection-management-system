@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- KPIs Section -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Key Performance Indicators (KPI)</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Total Active Inspections -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm text-gray-600 mb-2">TOTAL ACTIVE<br>INSPECTIONS</p>
            <p class="text-5xl font-bold text-gray-900">{{ $total_active_inspections }}</p>
        </div>

        <!-- Inspections Completed -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm text-gray-600 mb-2">INSPECTIONS<br>COMPLETED (THIS MONTH)</p>
            <div class="flex items-center">
                <p class="text-5xl font-bold text-gray-900">{{ $inspections_completed_this_month }}</p>
                <svg class="w-6 h-6 text-green-500 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="8" fill="#22c55e"/>
                    <path fill="white" d="M7 10l2 2 4-4"/>
                </svg>
            </div>
        </div>

        <!-- Average Duration -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm text-gray-600 mb-2">AVERAGE INSPECTION<br>DURATION</p>
            <div class="flex items-baseline space-x-2">
                <p class="text-5xl font-bold text-gray-900">{{ $average_inspection_duration }}</p>
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </div>
            <p class="text-xs text-gray-500 mt-1">HOURS</p>
            <div class="mt-2">
                <canvas id="avgDurationChart" height="40"></canvas>
            </div>
        </div>

        <!-- Inspections Completed Change -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm text-gray-600 mb-2">INSPECTIONS<br>COMPLETED</p>
            <div class="flex items-baseline space-x-2">
                <p class="text-5xl font-bold text-gray-900">+{{ $inspections_completed_change }}%</p>
            </div>
            <p class="text-xs text-gray-500 mt-1">vs Last Month</p>
        </div>

        <!-- Overdue Inspections -->
        <div class="bg-red-50 border-2 border-red-300 p-6 rounded-xl shadow-lg">
            <p class="text-sm text-gray-600 mb-2">OVERDUE<br>INSPECTIONS</p>
            <p class="text-5xl font-bold text-red-600">{{ $overdue_inspections }}</p>
        </div>
    </div>
</div>

<!-- Status Tracking and Non-Compliance Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Status Tracking -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Status Tracking</h3>
        <div class="grid grid-cols-2 gap-6">
            <!-- Inspection Status Breakwan -->
            <div>
                <h4 class="text-sm font-semibold text-gray-700 mb-4">INSPECTION STATUS BREAKWAN</h4>
                <div class="flex justify-center">
                    <canvas id="statusChart" width="200" height="200"></canvas>
                </div>
            </div>

            <!-- Inspection Type Distribution -->
            <div>
                <h4 class="text-sm font-semibold text-gray-700 mb-4">INSPECTION TYPE DISTRIBUTION</h4>
                <div class="flex justify-center">
                    <canvas id="typeChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Non-Compliance & Action Items -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Non-Compliance & Action Items</h3>
        
        <!-- Open Non-Compliance Issues -->
        <div class="bg-red-50 border-2 border-red-300 p-6 rounded-xl mb-6">
            <p class="text-sm text-gray-600 mb-2">OPEN NON-COMPLIANCE ISSUES</p>
            <p class="text-6xl font-bold text-gray-900">{{ $open_non_compliance_issues }}</p>
        </div>

        <!-- NCs by Severity -->
        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-4">NCs BY SEVERITY</h4>
            <div class="flex justify-center">
                <canvas id="severityChart" width="300" height="150"></canvas>
            </div>
        </div>

        <!-- Overdue Corrective Actions -->
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3">OVERDUE CORRECTIVE ACTIONS</h4>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-start space-x-2">
                    <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-700 font-medium">Bldg A - Fire Extinguisher (3 Days Overdue)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Status Breakdown Donut Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Scheduled', 'Ready', 'In Progress', 'For Review'],
            datasets: [{
                data: [{{ $status_scheduled }}, {{ $status_ready }}, {{ $status_in_progress }}, {{ $status_for_review }}],
                backgroundColor: ['#800000', '#FFD700', '#4d0000', '#999999'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { fontSize: 10 }
                }
            }
        }
    });

    // Type Distribution Bar Chart
    const typeCtx = document.getElementById('typeChart').getContext('2d');
    new Chart(typeCtx, {
        type: 'bar',
        data: {
            labels: ['Safety', 'Infrastructure', 'Equipment', 'Compliance'],
            datasets: [{
                data: [{{ $type_safety }}, {{ $type_infrastructure }}, {{ $type_equipment }}, {{ $type_compliance }}],
                backgroundColor: '#800000',
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: { beginAtZero: true, max: 100 }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Severity Chart
    const severityCtx = document.getElementById('severityChart').getContext('2d');
    new Chart(severityCtx, {
        type: 'bar',
        data: {
            labels: ['Critical', 'Major', 'Minor'],
            datasets: [{
                data: [{{ $nc_critical }}, {{ $nc_major }}, {{ $nc_minor }}],
                backgroundColor: ['#991b1b', '#b91c1c', '#dc2626'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Average Duration Trend
    const avgDurationCtx = document.getElementById('avgDurationChart').getContext('2d');
    new Chart(avgDurationCtx, {
        type: 'line',
        data: {
            labels: ['1m', '2m', '3m'],
            datasets: [{
                data: [16, 17.5, 18.67],
                borderColor: '#FFD700',
                backgroundColor: 'rgba(255, 215, 0, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { display: false },
                y: { display: false }
            }
        }
    });
</script>
@endpush
