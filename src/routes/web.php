<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Auth\LoginController;

// --- 1. Guest Routes (Đăng nhập) ---
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// --- 2. Admin Routes (Quản trị) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    
    // Trang chủ Admin
    Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');
    
    // Quản lý Campaign (Tạo, sửa, xóa)
    Route::resource('campaigns', 'App\Http\Controllers\CampaignController');
    
    // Tìm kiếm Subscriber bằng AJAX (Task 4.6)
    Route::get('/subscribers/search', 'App\Http\Controllers\SubscriberController@search');
});

// --- 3. User Routes (Người nhận thông báo) ---
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/notifications', 'App\Http\Controllers\UserController@notifications')->name('user.notifications');
});
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');