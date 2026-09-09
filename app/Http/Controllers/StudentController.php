<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
     public function index()
    {
        $students = Student::with(['user', 'classRoom'])->latest()->get();
        return view('admin.students.index', compact('students'));
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
            'roll_number' => 'required|string|unique:students',
            'father_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);

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
            'roll_number' => 'required|string|unique:students,roll_number,' . $student->id,
            'father_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
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

    // Delete karna
    public function destroy(Student $student)
    {
        $student->user->delete(); // cascade delete se student record bhi khud delete ho jayega
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
