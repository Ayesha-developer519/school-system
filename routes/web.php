<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\FeePaymentController;





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
    Route::get('/admin/students/class/{classRoom}', [StudentController::class, 'byClass'])->name('students.by-class');
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

    Route::get('/admin/attendance', [AttendanceController::class, 'adminIndex'])->name('admin.attendance.index');
    Route::get('/admin/attendance/class/{classRoom}', [AttendanceController::class, 'adminByClass'])->name('admin.attendance.by-class');

    Route::get('/admin/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/admin/subjects/class/{classRoom}', [SubjectController::class, 'byClass'])->name('subjects.by-class');
    Route::get('/admin/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/admin/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/admin/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/admin/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/admin/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');


    Route::get('/admin/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/admin/exams/class/{classRoom}', [ExamController::class, 'byClass'])->name('exams.by-class');
    Route::get('/admin/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/admin/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/admin/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/admin/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/admin/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');
    Route::get('/admin/exams/{exam}/results', [ResultController::class, 'manage'])->name('results.manage');

    Route::get('/admin/fee-structures', [FeeStructureController::class, 'index'])->name('fee-structures.index');
    Route::get('/admin/fee-structures/class/{classRoom}', [FeeStructureController::class, 'byClass'])->name('fee-structures.by-class');
    Route::post('/admin/fee-structures', [FeeStructureController::class, 'store'])->name('fee-structures.store');
    Route::get('/admin/fee-payments', [FeePaymentController::class, 'index'])->name('fee-payments.index');
    Route::get('/admin/fee-payments/class/{classRoom}', [FeePaymentController::class, 'byClass'])->name('fee-payments.by-class');
    Route::post('/admin/fee-payments', [FeePaymentController::class, 'store'])->name('fee-payments.store');
    Route::get('/admin/fee-payments/student/{student}', [FeePaymentController::class, 'show'])->name('fee-payments.show');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/teacher/attendance', [AttendanceController::class, 'selectClass'])->name('attendance.select');
    Route::get('/teacher/attendance/mark', [AttendanceController::class, 'markForm'])->name('attendance.mark');
    Route::post('/teacher/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/teacher/attendance/history', [AttendanceController::class, 'history'])->name('attendance.history');

    Route::get('/teacher/results', [ResultController::class, 'selectExam'])->name('results.select');
    Route::get('/teacher/results/mark', [ResultController::class, 'markForm'])->name('results.mark');
    Route::post('/teacher/results', [ResultController::class, 'store'])->name('results.store');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [DashboardController::class, 'student'])->name('student.dashboard');
});

// Parent Routes
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'parent'])->name('parent.dashboard');
});