<?php

use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminGeneralWorshipController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('client.home');
Route::get('/warta-jemaat', [ClientController::class, 'announcements'])->name('client.announcements');
Route::get('/jadwal-ibadah', [ClientController::class, 'scheduleWorship'])->name('client.schedule-worship');
Route::get('/jadwal-ibadah/umum', [ClientController::class, 'scheduleWorshipUmum'])->name('client.schedule-worship.umum');
Route::get('/jadwal-ibadah/{id}', [ClientController::class, 'scheduleWorshipDetail'])->whereNumber('id')->name('client.schedule-worship.detail');
Route::get('/kegiatan-gereja', [ClientController::class, 'events'])->name('client.events');
Route::get('/kegiatan-gereja/cari', [ClientController::class, 'eventSearch'])->name('client.events.search');
Route::get('/kegiatan-gereja/{slug}', [ClientController::class, 'eventDetail'])->name('client.events.detail');
Route::get('/kegiatan-gereja/tahun/{year}', [ClientController::class, 'eventArchive'])->name('client.events.archive');
Route::get('/tentang-gereja', [ClientController::class, 'aboutChurch'])->name('client.about-church');
Route::get('/tentang-kategorial', [ClientController::class, 'aboutKategorial'])->name('client.about-kategorial');
Route::get('/tentang-kategorial/{slug}', [ClientController::class, 'kategorialDetail'])->name('client.about-kategorial.detail');

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

    Route::resource('events', AdminEventController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::get('schedules/umum', fn () => redirect()->route('admin.worships.index'));
    Route::resource('schedules', AdminScheduleController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::get('jadwal-ibadah/kategorial', [AdminScheduleController::class, 'kategorial'])->name('schedules.kategorial');

    Route::controller(AdminGeneralWorshipController::class)->group(function () {
        Route::get('jadwal-ibadah/umum', 'index')->name('worships.index');
        Route::post('jadwal-ibadah/umum', 'store')->name('worships.store');
        Route::get('jadwal-ibadah/umum/{worship}/edit', 'edit')->name('worships.edit');
        Route::match(['put', 'patch'], 'jadwal-ibadah/umum/{worship}', 'update')->name('worships.update');
        Route::delete('jadwal-ibadah/umum/{worship}', 'destroy')->name('worships.destroy');
        Route::get('jadwal-ibadah/umum/{worship}', 'show')->name('worships.show');
    });

    Route::resource('announcements', AdminAnnouncementController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('categories', AdminCategoryController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});

// User management - hanya super_admin
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
