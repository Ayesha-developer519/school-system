<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('students')->latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:10',
        ]);

        ClassRoom::create([
            'class_name' => $request->class_name,
            'section' => $request->section,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class added successfully.');
    }

    public function show(ClassRoom $classRoom)
    {
        $classRoom->load('students.user');
        return view('admin.classes.show', compact('classRoom'));
    }

    public function edit(ClassRoom $classRoom)
    {
        return view('admin.classes.edit', compact('classRoom'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:10',
        ]);

        $classRoom->update([
            'class_name' => $request->class_name,
            'section' => $request->section,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id');
    }
}
