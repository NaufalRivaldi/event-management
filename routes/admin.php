<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{
    LoginController
};
use App\Http\Controllers\Admin\{
    AnggotaController,
    EventController,
    EventListController,
    DashboardController,
    ProfileController,
    UserController,
};

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

/**
 * --------------------------------------------------------------------------
 * Auth Routes
 * --------------------------------------------------------------------------
 */
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'attempt'])->name('login.attempt');
Route::get('/register', [LoginController::class, 'register'])->name('register');

/**
 * --------------------------------------------------------------------------
 * Admin Routes
 * --------------------------------------------------------------------------
 */
Route::middleware(['auth'])->group(function () {
    /**
     * ----------------------------------------------------------------------
     * Auth / Profile Routes
     * ----------------------------------------------------------------------
     */
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile-password/{user}', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    /**
     * ----------------------------------------------------------------------
     * Admin Routes
     * ----------------------------------------------------------------------
     */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::resource('events', EventController::class);

    Route::get('/event-list', [EventListController::class, 'index'])->name('event-list.index');
    Route::get('/event-list/{event}', [EventListController::class, 'show'])->name('event-list.show');
    Route::post('/event-list/{event}', [EventListController::class, 'absen'])->name('event-list.absen');
});