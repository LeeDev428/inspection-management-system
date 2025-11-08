<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InspectionRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest routes (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Profile routes (available to all authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/requests', [InspectionRequestController::class, 'adminIndex'])->name('admin.requests.index');
        Route::get('/admin/requests/pending', [InspectionRequestController::class, 'adminPending'])->name('admin.requests.pending');
        Route::get('/admin/requests/{request}', [InspectionRequestController::class, 'adminShow'])->name('admin.requests.show');
        Route::post('/admin/requests/{inspectionRequest}/approve', [InspectionRequestController::class, 'approve'])->name('admin.requests.approve');
        Route::post('/admin/requests/{inspectionRequest}/deny', [InspectionRequestController::class, 'deny'])->name('admin.requests.deny');
    });
    
    // User routes
    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
        Route::get('/requests', [InspectionRequestController::class, 'index'])->name('user.requests.index');
        Route::get('/requests/create', [InspectionRequestController::class, 'create'])->name('user.requests.create');
        Route::post('/requests', [InspectionRequestController::class, 'store'])->name('user.requests.store');
        Route::get('/requests/upload', [InspectionRequestController::class, 'uploadForm'])->name('user.requests.upload');
        Route::post('/requests/upload', [InspectionRequestController::class, 'uploadFile'])->name('user.requests.upload.store');
        Route::get('/requests/{request}', [InspectionRequestController::class, 'show'])->name('user.requests.show');
    });
});
