@extends('layouts.user')

@section('title', 'Upload Document')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Upload Inspection Document</h2>
        <p class="text-gray-600 mt-2">Upload a scanned copy of your hardcopy inspection request form</p>
    </div>

    <form action="{{ route('user.requests.upload.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8">
        @csrf

        <!-- File Upload -->
        <div class="mb-6">
            <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">Upload Document <span class="text-red-500">*</span></label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-maroon transition">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-maroon hover:text-maroon-dark">
                            <span>Upload a file</span>
                            <input id="file" name="file" type="file" accept="image/*,.pdf" required class="sr-only" onchange="previewFile(this)">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                </div>
            </div>
            @error('file')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            
            <!-- Preview -->
            <div id="preview" class="mt-4 hidden">
                <img id="preview-image" class="max-w-full h-auto rounded-lg border" alt="Preview">
            </div>
        </div>

        <!-- Office/Department -->
        <div class="mb-6">
            <label for="office_department" class="block text-sm font-semibold text-gray-700 mb-2">Office/Department <span class="text-red-500">*</span></label>
            <input type="text" name="office_department" id="office_department" required value="{{ old('office_department') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                   placeholder="Enter your office or department">
            @error('office_department')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Purpose -->
        <div class="mb-6">
            <label for="purpose" class="block text-sm font-semibold text-gray-700 mb-2">Purpose <span class="text-red-500">*</span></label>
            <textarea name="purpose" id="purpose" rows="4" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                      placeholder="Briefly describe the purpose of this inspection">{{ old('purpose') }}</textarea>
            @error('purpose')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-medium">
                Upload Document
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewFile(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            const previewImage = document.getElementById('preview-image');
            previewImage.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
