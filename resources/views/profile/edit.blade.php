@extends('layouts.user')

@section('title', 'Profile Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Profile Settings</h2>
        <p class="text-gray-600 mt-2">Manage your account information and password</p>
    </div>

    <!-- Profile Information -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Profile Information</h3>
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <input type="text" value="{{ ucfirst($user->role) }}" disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
                <p class="text-xs text-gray-500 mt-1">Role cannot be changed</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-maroon text-white rounded-lg hover:bg-maroon-light transition font-medium">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Change Password</h3>
        
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                <input type="password" name="current_password" id="current_password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition font-medium">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Account Information -->
    <div class="bg-gray-50 rounded-xl p-6 mt-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Account Information</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Account Created:</span>
                <span class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Last Updated:</span>
                <span class="text-gray-900">{{ $user->updated_at->format('M d, Y h:i A') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">User ID:</span>
                <span class="text-gray-900">#{{ $user->id }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
