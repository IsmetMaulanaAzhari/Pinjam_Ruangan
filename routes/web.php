<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DaftarPinjamController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', ['title' => "Home"]);
});

// -----------------------------
// AUTH ROUTES
// -----------------------------
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// -----------------------------
// AUTHENTICATED AREA
// -----------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard Overview
    Route::get('/dashboard/overview', function () {
        return view('dashboard.overview.index', ['title' => "Dashboard Overview"]);
    });

    // -----------------------------
    // ADMIN AREA (with checkRole)
    // -----------------------------
    Route::middleware(['checkRole'])->group(function () {

        // Temporary Rents
        Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index']);
        Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents']);
        Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents']);

        // Dashboard Resources
        Route::resource('/dashboard/rents', DashboardRentController::class)
            ->names('dashboard.rents');

        Route::resource('/dashboard/rooms', DashboardRoomController::class, [
            'parameters' => ['room' => 'code']
        ])
            ->names('dashboard.rooms')
            ->except(['create', 'edit']);

        Route::resource('/dashboard/users', DashboardUserController::class)
            ->names('dashboard.users');

       Route::resource('/dashboard/admin', DashboardAdminController::class)
            ->names([
                'index' => 'dashboard.admin.index',
                'create' => 'dashboard.admin.create',
                'store' => 'dashboard.admin.store',
                'edit' => 'dashboard.admin.edit',
                'update' => 'dashboard.admin.update',
                'destroy' => 'dashboard.admin.destroy',
            ]);
            
        // Custom Admin Routes
        Route::get('/dashboard/rents/{id}/endTransaction', [DashboardRentController::class, 'endTransaction']);
        Route::get('/dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin']);
        Route::get('/dashboard/admin/{id}/removeAdmin', [DashboardAdminController::class, 'removeAdmin']);
        Route::put('/dashboard/admin/room/{id}', [DashboardAdminController::class, 'updateRoom'])
            ->name('dashboard.admin.room.update');
    });

    // -----------------------------
    // USER AREA (Daftar Ruangan & Peminjaman)
    // -----------------------------
    Route::get('/daftarruang', [DaftarRuangController::class, 'index'])->name('daftarruang');
    Route::get('/showruang/{room:code}', [DaftarRuangController::class, 'show'])->name('showruang');
    Route::get('/daftarpinjam', [DaftarPinjamController::class, 'index'])->name('daftarpinjam');
    Route::post('/daftarpinjam', [DaftarPinjamController::class, 'store'])->name('daftarpinjam.store');
});
