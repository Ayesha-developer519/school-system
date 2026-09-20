<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ClassRoom;

class ExamController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('exams')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.exams.index', compact('classes'));
    }

    public function byClass(ClassRoom $classRoom)
    {
        $classRoom->load('exams');
        return view('admin.exams.by-class', compact('classRoom'));
    }

    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.exams.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'exam_name' => 'required|in:Firstterm,Secondterm,Final',
            'exam_date' => 'required|date',
        ]);

        Exam::create($request->only('class_id', 'exam_name', 'exam_date'));

        return redirect()->route('exams.index')->with('success', 'Exam added successfully.');
    }

    public function edit(Exam $exam)
    {
        $classes = ClassRoom::all();
        return view('admin.exams.edit', compact('exam', 'classes'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'exam_name' => 'required|in:Firstterm,Secondterm,Final',
            'exam_date' => 'required|date',
        ]);

        $exam->update($request->only('class_id', 'exam_name', 'exam_date'));

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }
}
