<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassRoom;

class SubjectController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('subjects')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.subjects.index', compact('classes'));
    }

    public function byClass(ClassRoom $classRoom)
    {
        $classRoom->load('subjects');
        return view('admin.subjects.by-class', compact('classRoom'));
    }

    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name,NULL,id,class_id,' . $request->class_id,
        ], [
            'subject_name.unique' => 'This subject already exists for the selected class.',
        ]);

        Subject::create([
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }

    public function edit(Subject $subject)
    {
        $classes = ClassRoom::all();
        return view('admin.subjects.edit', compact('subject', 'classes'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name,' . $subject->id . ',id,class_id,' . $request->class_id,
        ], [
            'subject_name.unique' => 'This subject already exists for the selected class.',
        ]);

        $subject->update([
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
