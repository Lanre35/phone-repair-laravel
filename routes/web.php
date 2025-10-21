<?php

use App\Models\Phone;
use App\Models\Repair;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PhoneModelController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Resource routes for the main functionality
Route::resource('customers', CustomerController::class)->middleware('auth');

Route::resource('inventories', InventoryController::class)->middleware('auth');
Route::resource('setting',SettingsController::class)->middleware('auth');

Route::resource('add-phone-model',PhoneModelController::class)->middleware('auth');
Route::resource('priority',PriorityController::class)->middleware('auth');
Route::resource('status', StatusController::class)->middleware('auth');

Route::post('repairs/status/{id}',[StatusController::class,'update'])->middleware('auth');
Route::post('repairs/priority/{id}',[PriorityController::class,'update'])->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');

Route::controller(PhoneController::class)->middleware('auth')->group(function(){
    Route::get('phones/{id}',[PhoneController::class,'show'])->name('show');
    Route::delete('phones/{id}',[PhoneController::class,'destroy'])->name('destroy');
    Route::get('phones/phone-edit/{id}',[PhoneController::class,'edit'])->name('edit');
    Route::resource('phones',PhoneController::class);
    Route::resource('add-phone-name', PhoneController::class);
});

Route::controller(RepairController::class)->middleware('auth')->group(function () {
    Route::resource('repairs', RepairController::class);
    Route::get('show/{id}', [RepairController::class, 'show']);
    Route::get('edit/{id}', [RepairController::class, 'edit']);
    Route::get('repairs/restore/{id}', [RepairController::class, 'restore'])->name('repairs.restore');
    Route::get('search-by-ticket', [RepairController::class, 'searchByTicket'])->name('search.by.ticket');
});



Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

