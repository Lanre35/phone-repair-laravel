<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PhoneModelController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Resource routes for the main functionality
Route::resource('customers', CustomerController::class);
Route::resource('repairs', RepairController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('setting',SettingsController::class);
Route::resource('add-phone-name',PhoneController::class);
Route::resource('add-phone-model',PhoneModelController::class);
Route::resource('priority',PriorityController::class);
Route::resource('status', StatusController::class);
Route::post('repairs/status/{id}',[StatusController::class,'update']);
Route::post('repairs/priority/{id}',[PriorityController::class,'update']);
Route::get('show/{id}',[RepairController::class,'show'])->name('repairs.show');
Route::get('edit/{id}',[RepairController::class,'edit'])->name('repairs.edit');

