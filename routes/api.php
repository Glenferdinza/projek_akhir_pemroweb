<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;

Route::prefix('v1')->group(function () {
    // Public API routes
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::get('/events/search', [EventController::class, 'search']);
    Route::get('/categories', [EventCategoryController::class, 'index']);
    Route::get('/categories/{category:slug}', [EventCategoryController::class, 'show']);

    // Authenticated API routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/events', [EventController::class, 'store']);
        Route::put('/events/{event}', [EventController::class, 'update']);
        Route::delete('/events/{event}', [EventController::class, 'destroy']);
        
        Route::post('/events/{event}/register', [EventController::class, 'register']);
        Route::delete('/events/{event}/register', [EventController::class, 'cancelRegistration']);
        
        Route::get('/my-events', [EventController::class, 'myEvents']);
        
        Route::post('/categories', [EventCategoryController::class, 'store']);
    });
});