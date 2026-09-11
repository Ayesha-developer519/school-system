<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\ClassRoom;    
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['user', 'classes'])->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.teachers.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'qualification' => 'nullable|string|max:255',
            'subject_specialization' => 'nullable|string|max:255',
            'joining_date' => 'required|date',
            'classes' => 'nullable|array',
            'classes.*' => 'exists:classes,id',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'teacher',
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'qualification' => $request->qualification,
                'subject_specialization' => $request->subject_specialization,
                'joining_date' => $request->joining_date,
            ]);

            $teacher->classes()->sync($request->classes ?? []);
        });

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load(['user', 'classes']);
        $classes = ClassRoom::all();
        return view('admin.teachers.edit', compact('teacher', 'classes'));
    }

    public function update(Request $request, Teacher $teacher)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->user_id,
            'qualification' => 'nullable|string|max:255',
            'subject_specialization' => 'nullable|string|max:255',
            'joining_date' => 'required|date',
            'classes' => 'nullable|array',
            'classes.*' => 'exists:classes,id',
        ]);

        $teacher->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $teacher->update([
            'qualification' => $request->qualification,
            'subject_specialization' => $request->subject_specialization,
            'joining_date' => $request->joining_date,
        ]);

        $teacher->classes()->sync($request->classes ?? []);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['user', 'classes']);
        return view('admin.teachers.show', compact('teacher'));
    }
}
