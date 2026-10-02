<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    fn () => redirect()->route(
        'activities.index'
    )
);

Route::get(
    '/activities-trash',
    [ActivityController::class, 'trash']
)->name('activities.trash');

Route::patch(
    '/activities-trash/{id}/restore',
    [ActivityController::class, 'restore']
)->name('activities.restore');

Route::post(
    '/activities/{activity}/publish',
    [ActivityController::class, 'publish']
)->name('activities.publish');

Route::post(
    '/activities/{activity}/complete',
    [ActivityController::class, 'complete']
)->name('activities.complete');

Route::post(
    '/activities/{activity}/registrations',
    [RegistrationController::class, 'store']
)->name('activities.registrations.store');

Route::get(
    '/categories',
    [CategoryController::class, 'index']
)->name('categories.index');

Route::delete(
    '/categories/{category}',
    [CategoryController::class, 'destroy']
)->name('categories.destroy');

Route::resource(
    'activities',
    ActivityController::class
);