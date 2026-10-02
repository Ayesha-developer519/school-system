<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\Exam;
use App\Models\Result;
use App\Models\FeePayment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('students')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.students.index', compact('classes'));
    }

    public function byClass(ClassRoom $classRoom)
    {
        $classRoom->load('students.user');
        return view('admin.students.by-class', compact('classRoom'));
    }

    // Add student form dikhana
    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.students.create', compact('classes'));
    }

    // Naya student save karna
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'class_id' => 'required|exists:classes,id',
            'roll_number' => [
                'required',
                'integer',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            'father_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
        ], [
            'roll_number.unique' => 'This roll number is already taken in the selected class.',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);

            
            // Unique invite code generate karna
            do {
                $inviteCode = 'SMS-' . strtoupper(\Illuminate\Support\Str::random(6));
            } while (Student::where('invite_code', $inviteCode)->exists());


            Student::create([
                'user_id' => $user->id,
                'class_id' => $request->class_id,
                'roll_number' => $request->roll_number,
                'father_name' => $request->father_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'admission_date' => $request->admission_date,
            ]);
        });

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    //show the student  
    public function show(Student $student)
    {
        $student->load(['user', 'classRoom']);
        return view('admin.students.show', compact('student'));
    }

    // Edit form dikhana
    public function edit(Student $student)
    {
        $classes = ClassRoom::all();
        $student->load('user');
        return view('admin.students.edit', compact('student', 'classes'));
    }

    // Update karna
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->user_id,
            'class_id' => 'required|exists:classes,id',
            'roll_number' => [
                'required',
                'integer',
                Rule::unique('students')
                    ->where(function ($query) use ($request) {
                        return $query->where('class_id', $request->class_id);
                    })
                    ->ignore($student->id),
            ],
            'father_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
        ], [
            'roll_number.unique' => 'This roll number is already taken in the selected class.',
        ]);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $student->update([
            'class_id' => $request->class_id,
            'roll_number' => $request->roll_number,
            'father_name' => $request->father_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }



    //student portal methods

    // Student: apni attendance history dekhna
    public function myAttendance()
    {
        $student = auth()->user()->student;

        $records = Attendance::where('student_id', $student->id)
            ->orderByDesc('date')
            ->get();

        $totalDays = $records->count();
        $presentDays = $records->where('status', 'present')->count();
        $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

        return view('student.attendance', compact('records', 'percentage', 'totalDays', 'presentDays'));
    }

    // Student: apne exams ki list
    public function myResultsIndex()
    {
        $student = auth()->user()->student;

        $exams = Exam::where('class_id', $student->class_id)->latest('exam_date')->get();

        return view('student.results-index', compact('exams'));
    }

    // Student: ek specific exam ka result dekhna
    public function myResultShow(Exam $exam)
    {
        $student = auth()->user()->student;

        if ($exam->class_id != $student->class_id) {
            abort(403, 'This exam does not belong to your class.');
        }

        $results = Result::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->with('subject')
            ->get();

        $totalObtained = $results->sum('marks_obtained');
        $totalMax = $results->sum('total_marks');
        $overallPercentage = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : null;

        return view('student.result-show', compact('exam', 'results', 'overallPercentage'));
    }

    // Student: apni fee status dekhna
    public function myFees()
    {
        $student = auth()->user()->student;
        $student->load('classRoom.feeStructure');

        $payments = FeePayment::where('student_id', $student->id)
            ->orderByDesc('payment_date')
            ->get();

        return view('student.fees', compact('student', 'payments'));
    }

}
