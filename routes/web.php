<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
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
    Route::post('/login', [AuthController::class, 'attempt'])->name('login.attempt');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'dashboard'
], function () {
    Route::get('/{filter?}', [DashboardController::class, 'index'])->name('dashboard')->where(['filter'=>'all']);
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/{filter?}', [BankController::class, 'index'])->name('bank');
        Route::put('/', [BankController::class, 'update'])->name('bank.update');
    });
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/{filter?}', [CheckoutController::class, 'index'])->name('checkout');
        Route::put('/', [CheckoutController::class, 'update'])->name('checkout.update');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transaction');
        Route::post('/', [TransactionController::class, 'execute'])->name('transaction.execute');
    });
});
