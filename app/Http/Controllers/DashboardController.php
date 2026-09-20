<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalStudents = \App\Models\Student::count();
        $totalTeachers = \App\Models\User::where('role', 'teacher')->count();
        $totalClasses = \App\Models\ClassRoom::count();
        $feeCollected = \App\Models\FeePayment::where('status', 'paid')->sum('amount_paid');

        return view('admin.dashboard', compact('totalStudents', 'totalTeachers', 'totalClasses', 'feeCollected'));
    }

    public function teacher()
    {
        $teacher = auth()->user()->teacher;
        $totalClasses = $teacher->classes->count();
        $totalStudents = $teacher->classes->sum(fn($class) => $class->students->count());

        $todayMarked = \App\Models\Attendance::where('marked_by', $teacher->id)
            ->where('date', now()->toDateString())
            ->exists();

        return view('teacher.dashboard', compact('totalClasses', 'totalStudents', 'todayMarked'));
    }

    public function student()
    {
        return view('student.dashboard');
    }

    public function parent()
    {
        return view('parent.dashboard');
    }
}
