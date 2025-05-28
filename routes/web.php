<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\DashboardController;

// Homepage route (public)
Route::get('/', function () {
    return view('Homepage.home');
})->name('home');

// Guest routes (untuk user yang belum login)
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Public routes
Route::get('/browse', function () {
    return view('browse');
})->name('browse');

Route::get('/create', function () {
    return view('create');
})->name('create.page');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Public Event routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Category routes - Public
Route::get('/categories', [EventCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [EventCategoryController::class, 'show'])->name('categories.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard API Routes
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/recent-events', [DashboardController::class, 'getRecentEvents'])->name('dashboard.recent-events');
    Route::get('/dashboard/notifications', [DashboardController::class, 'getNotifications'])->name('dashboard.notifications');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');
    Route::get('/dashboard/recent-activities', [DashboardController::class, 'getRecentActivities'])->name('dashboard.recent-activities');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile Routes
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
    
    // Event routes - Protected
    Route::prefix('events')->name('events.')->group(function () {
        // Create & Store
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        
        // Edit & Update
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('update');
        
        // Delete
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
        
        // Registration
        Route::post('/{event}/register', [EventController::class, 'register'])->name('register');
        Route::delete('/{event}/register', [EventController::class, 'cancelRegistration'])->name('cancel-registration');
        
        // Join event
        Route::post('/{event}/join', [EventController::class, 'join'])->name('join');
    });
    
    // User's events
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my-events');
    Route::get('/my-events/created', [EventController::class, 'createdEvents'])->name('events.created');
    Route::get('/my-events/registered', [EventController::class, 'registeredEvents'])->name('events.registered');
});

// API routes untuk AJAX
Route::prefix('api')->name('api.')->group(function () {
    // Public API
    Route::get('/events', [EventController::class, 'getEvents'])->name('events');
    Route::get('/categories', [EventCategoryController::class, 'getCategories'])->name('categories');
    
    // Protected API
    Route::middleware('auth')->group(function () {
        Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
        Route::get('/my-events', [EventController::class, 'myEvents'])->name('my-events');
    });
});

// Contact/Message routes
Route::post('/contact', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ]);
    
    // Handle contact form submission
    return redirect()->back()->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');

// Newsletter subscription
Route::post('/newsletter', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email|max:255',
    ]);
    
    // Handle newsletter subscription
    return redirect()->back()->with('success', 'Thank you for subscribing!');
})->name('newsletter.subscribe');

// Subscribe route
Route::post('/subscribe', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email|max:255',
    ]);
    
    // Handle subscription
    return redirect()->back()->with('success', 'Thank you for subscribing!');
})->name('subscribe');

// Fallback route
Route::fallback(function () {
    return view('errors.404');
});