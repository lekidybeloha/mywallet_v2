<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [AuthController::class, 'dashboardRouter'])->middleware(['auth'])->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'dashboard'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/', [BankController::class, 'index'])->name('dashboard.bank');
    });
});
