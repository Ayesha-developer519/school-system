<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

//role based authentication

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher']);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [DashboardController::class, 'student']);
});

Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'parent']);
});
