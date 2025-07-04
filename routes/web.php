<?php

use App\Models\Room;
use App\Models\Building;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DaftarPinjamController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'title' => "Home",
    ]);
});

// Routes untuk login dan register
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register']);

// Routes yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {

    // Dashboard Overview
    Route::get('/dashboard/overview', function () {
        return view('/dashboard/overview/index', [
            'title' => "Dashboard Admin",
        ]);
    });

    // Routes dengan middleware tambahan (checkRole)
    Route::middleware(['checkRole'])->group(function () {
        Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index']);
        Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents']);
        Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents']);
        Route::resource('dashboard/rents', DashboardRentController::class);
        Route::resource('dashboard/rooms', DashboardRoomController::class);
        Route::resource('dashboard/users', DashboardUserController::class);
        Route::resource('dashboard/admin', DashboardAdminController::class);
        Route::get('dashboard/rents/{id}/endTransaction', [DashboardRentController::class, 'endTransaction']);
        Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin']);
        Route::get('dashboard/admin/{id}/removeAdmin', [DashboardAdminController::class, 'removeAdmin']);
        Route::get('/dashboard/admin/room/{id}/edit', [DashboardAdminController::class, 'editRoom'])->name('admin.room.edit');
    Route::put('/dashboard/admin/room/{id}', [DashboardAdminController::class, 'updateRoom'])->name('admin.room.update');
    });

// Routes untuk daftar ruang dan daftar pinjam
Route::get('/daftarruang', [DaftarRuangController::class, 'index'])->name('daftarruang');
Route::get('/showruang/{room:code}', [DaftarRuangController::class, 'show'])->name('showruang');
Route::get('/daftarpinjam', [DaftarPinjamController::class, 'index'])->name('daftarpinjam');
Route::post('/daftarpinjam', [DaftarPinjamController::class, 'store'])->name('daftarpinjam.store');
Route::post('/logout', [LoginController::class, 'logout']);
});
