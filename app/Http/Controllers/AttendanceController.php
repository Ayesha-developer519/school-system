<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\ClassRoom;

class AttendanceController extends Controller
{
    // Teacher: apni classes ki list dikhana, class select karne ka form
    public function selectClass()
    {
        $teacher = auth()->user()->teacher;
        $classes = $teacher->classes;

        return view('teacher.attendance.select-class', compact('classes'));
    }

    // Teacher: class + date select karne ke baad students ki list dikhana
    public function markForm(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
        ]);

        $teacher = auth()->user()->teacher;

        if (!$teacher->classes->contains($request->class_id)) {
            abort(403, 'You are not assigned to this class.');
        }

        $classRoom = ClassRoom::with('students.user')->findOrFail($request->class_id);

        $existingAttendance = Attendance::where('class_id', $request->class_id)
            ->where('date', $request->date)
            ->pluck('status', 'student_id');

        return view('teacher.attendance.mark', [
            'classRoom' => $classRoom,
            'date' => $request->date,
            'existingAttendance' => $existingAttendance,
        ]);
    }

    // Attendance save/update karna
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,leave',
        ]);

        $teacher = auth()->user()->teacher;

        if (!$teacher->classes->contains($request->class_id)) {
            abort(403, 'You are not assigned to this class.');
        }

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'class_id' => $request->class_id,
                    'marked_by' => $teacher->id,
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Attendance saved successfully.');
    }

    public function history(Request $request)
    {
        $teacher = auth()->user()->teacher;
        $classes = $teacher->classes;

        $records = collect();
        $selectedClass = null;

        if ($request->filled('class_id') && $request->filled('date')) {
            if (!$teacher->classes->contains($request->class_id)) {
                abort(403, 'You are not assigned to this class.');
            }

            $selectedClass = ClassRoom::with('students.user')->findOrFail($request->class_id);

            $records = Attendance::where('class_id', $request->class_id)
                ->where('date', $request->date)
                ->get()
                ->keyBy('student_id');
        }

        return view('teacher.attendance.history', [
            'classes' => $classes,
            'selectedClass' => $selectedClass,
            'records' => $records,
            'date' => $request->date,
        ]);
    }

    // Admin: Class list dikhana
    public function adminIndex()
    {
        $classes = ClassRoom::withCount('students')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.attendance.index', compact('classes'));
    }

    // Admin: Ek specific class ki attendance dikhana (date ke sath)
    public function adminByClass(Request $request, ClassRoom $classRoom)
    {
        $date = $request->get('date', date('Y-m-d'));

        $classRoom->load('students.user');

        $records = Attendance::where('class_id', $classRoom->id)
            ->where('date', $date)
            ->get()
            ->keyBy('student_id');

        return view('admin.attendance.by-class', [
            'classRoom' => $classRoom,
            'date' => $date,
            'records' => $records,
        ]);
    }
}