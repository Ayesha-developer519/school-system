<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;



// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/admin/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/admin/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/admin/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/admin/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/admin/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::delete('/admin/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/admin/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/admin/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/admin/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/admin/classes/{classRoom}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/admin/classes/{classRoom}', [ClassController::class, 'update'])->name('classes.update');
    Route::get('/admin/classes/{classRoom}', [ClassController::class, 'show'])->name('classes.show');
    Route::delete('/admin/classes/{classRoom}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/admin/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/admin/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/admin/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::get('/admin/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::delete('/admin/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
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