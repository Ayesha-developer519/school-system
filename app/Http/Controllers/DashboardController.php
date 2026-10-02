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
        $student = auth()->user()->student;

        $totalDays = \App\Models\Attendance::where('student_id', $student->id)->count();
        $presentDays = \App\Models\Attendance::where('student_id', $student->id)->where('status', 'present')->count();
        $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

        $latestExam = \App\Models\Exam::where('class_id', $student->class_id)->latest('exam_date')->first();
        $latestResult = null;
        if ($latestExam) {
            $results = \App\Models\Result::where('exam_id', $latestExam->id)->where('student_id', $student->id)->get();
            $totalObtained = $results->sum('marks_obtained');
            $totalMax = $results->sum('total_marks');
            $latestResult = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : null;
        }

        $latestFeePayment = \App\Models\FeePayment::where('student_id', $student->id)->latest('payment_date')->first();
        $feeStatus = $latestFeePayment->status ?? 'pending';

        return view('student.dashboard', compact('attendancePercentage', 'latestResult', 'feeStatus'));
    }

    public function parent()
    {
        $children = auth()->user()->children()->with(['user', 'classRoom'])->get();

        $summaries = $children->map(function ($child) {
            $totalDays = \App\Models\Attendance::where('student_id', $child->id)->count();
            $presentDays = \App\Models\Attendance::where('student_id', $child->id)->where('status', 'present')->count();
            $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

            $latestFee = \App\Models\FeePayment::where('student_id', $child->id)->latest('payment_date')->first();

            return [
                'child' => $child,
                'attendancePercentage' => $attendancePercentage,
                'feeStatus' => $latestFee->status ?? 'pending',
            ];
        });

        return view('parent.dashboard', compact('summaries'));
    }
}
