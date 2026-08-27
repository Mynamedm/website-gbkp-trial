<?php

use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('home');
Route::get('/warta-jemaat', [ClientController::class, 'announcements'])->name('client.announcements');
Route::get('/jadwal-ibadah', [ClientController::class, 'scheduleWorship'])->name('client.schedule-worship');
Route::get('/jadwal-ibadah/{id}', [ClientController::class, 'scheduleWorshipDetail'])->name('client.schedule-worship.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - super_admin & admin bisa akses
Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('events', AdminEventController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');

    Route::resource('schedules', AdminScheduleController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('schedules/{schedule}/edit', [AdminScheduleController::class, 'edit'])->name('schedules.edit');

    Route::resource('announcements', AdminAnnouncementController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('announcements/{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('announcements.edit');

    Route::resource('categories', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
});

// User management - hanya super_admin
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
});

require __DIR__.'/auth.php';
