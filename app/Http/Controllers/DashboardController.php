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

        return view('admin.dashboard', compact('totalStudents', 'totalTeachers', 'totalClasses'));
    }

    public function teacher()
    {
        return view('teacher.dashboard');
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
