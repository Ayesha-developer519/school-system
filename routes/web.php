<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [DashboardController::class, 'student'])->name('student.dashboard');
});

// Parent Routes
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'parent'])->name('parent.dashboard');
});