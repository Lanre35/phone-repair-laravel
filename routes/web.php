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
Route::resource('customers', CustomerController::class)->middleware('auth');
Route::resource('repairs', RepairController::class)->middleware('auth');
Route::resource('inventories', InventoryController::class)->middleware('auth');
Route::resource('setting',SettingsController::class)->middleware('auth');
Route::resource('add-phone-name',PhoneController::class)->middleware('auth');
Route::resource('add-phone-model',PhoneModelController::class)->middleware('auth');
Route::resource('priority',PriorityController::class)->middleware('auth');
Route::resource('status', StatusController::class)->middleware('auth');

// none resource routes
Route::post('repairs/status/{id}',[StatusController::class,'update'])->middleware('auth');
Route::post('repairs/priority/{id}',[PriorityController::class,'update'])->middleware('auth');
Route::get('show/{id}',[RepairController::class,'show'])->name('repairs.show')->middleware('auth');
Route::get('edit/{id}',[RepairController::class,'edit'])->name('repairs.edit')->middleware('auth');
Route::get('phones/{id}',[PhoneController::class,'show'])->name('phones.show')->middleware('auth');
Route::delete('phones/{id}',[PhoneController::class,'destroy'])->name('phones.destroy')->middleware('auth');
Route::get('phones/phone-edit/{id}',[PhoneController::class,'edit'])->name('phones.edit')->middleware('auth');
Route::resource('phones',PhoneController::class)->middleware('auth');
Route::resource('products', \App\Http\Controllers\ProductController::class)->middleware('auth');

