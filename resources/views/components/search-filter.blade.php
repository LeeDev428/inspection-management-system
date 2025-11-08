<!-- Search and Filter Component -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <form method="GET" action="{{ $action }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search Bar -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           id="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by office, user, or purpose..."
                           class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="denied" {{ request('status') == 'denied' ? 'selected' : '' }}>Denied</option>
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="form" {{ request('type') == 'form' ? 'selected' : '' }}>Form Submission</option>
                    <option value="upload" {{ request('type') == 'upload' ? 'selected' : '' }}>Document Upload</option>
                </select>
            </div>
        </div>

        <!-- Date Range Filter -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                <input type="date" 
                       name="date_from" 
                       id="date_from" 
                       value="{{ request('date_from') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                <input type="date" 
                       name="date_to" 
                       id="date_to" 
                       value="{{ request('date_to') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
            </div>

            <!-- Sort By -->
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select name="sort" id="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="office" {{ request('sort') == 'office' ? 'selected' : '' }}>Office A-Z</option>
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4 border-t">
            <div class="text-sm text-gray-600">
                @if(request()->hasAny(['search', 'status', 'type', 'date_from', 'date_to', 'sort']))
                    <a href="{{ $action }}" class="text-maroon hover:underline">Clear Filters</a>
                @endif
            </div>
            <div class="flex space-x-3">
                <button type="submit" class="px-6 py-2 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-medium">
                    Apply Filters
                </button>
                <button type="button" onclick="exportData()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    📥 Export CSV
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function exportData() {
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'csv');
    window.location.href = '{{ $action }}?' + params.toString();
}
</script>
