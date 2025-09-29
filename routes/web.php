<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HouseOwnerController;
use App\Http\Controllers\Owner\BillController as OwnerBillController;
use App\Http\Controllers\Owner\FlatController as OwnerFlatController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;
use App\Http\Controllers\Admin\BuildingController as AdminBuildingController;


Route::get('/', function () {
    return view('welcome');
});

// Guest-only
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // TODO:: Remove registration this way
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth-only
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});

/*
|-------------------------------------------------------------------------
| Admin area
|-------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin can manage house owners
    Route::resource('houseowners', HouseOwnerController::class);
    // Admin can manage buildings across owners
    Route::resource('buildings', AdminBuildingController::class);
    // Admin tenant management (example)
    Route::resource('tenants', AdminTenantController::class);
});

/*
|-------------------------------------------------------------------------
| Owner area (owner role required + owner.access to protect owner resources)
|-------------------------------------------------------------------------
*/
Route::middleware(['auth','role:owner','owner.access'])->prefix('owner')->name('owner.')->group(function () {
    // Owner other resources
    Route::resource('flats', OwnerFlatController::class);
    Route::resource('bills', OwnerBillController::class);
    Route::post('bills/{bill}/pay', [OwnerBillController::class, 'pay'])->name('bills.pay');
});
