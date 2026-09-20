<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Result;
use App\Models\ClassRoom;

class ResultController extends Controller
{
    // Teacher: apni classes ke exams ki list
    public function selectExam()
    {
        $teacher = auth()->user()->teacher;
        $classIds = $teacher->classes->pluck('id');

        $exams = Exam::with('classRoom')->whereIn('class_id', $classIds)->latest()->get();

        return view('teacher.results.select-exam', compact('exams'));
    }

    // Teacher: exam + subject select karne ke baad marks entry form
    public function markForm(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $teacher = auth()->user()->teacher;
        $exam = Exam::with('classRoom.students.user')->findOrFail($request->exam_id);

        if (!$teacher->classes->contains($exam->class_id)) {
            abort(403, 'You are not assigned to this class.');
        }

        $existingResults = Result::where('exam_id', $exam->id)
            ->where('subject_id', $request->subject_id)
            ->get()
            ->keyBy('student_id');

        return view('teacher.results.mark', [
            'exam' => $exam,
            'subjectId' => $request->subject_id,
            'existingResults' => $existingResults,
        ]);
    }

    // Marks save karna
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
            'total_marks' => 'required|integer|min:1',
            'marks' => 'required|array',
            'marks.*' => 'required|integer|min:0|max:' . $request->total_marks,
        ]);

        $exam = Exam::findOrFail($request->exam_id);
        $teacher = auth()->user()->teacher;

        if (!$teacher->classes->contains($exam->class_id)) {
            abort(403, 'You are not assigned to this class.');
        }

        foreach ($request->marks as $studentId => $marksObtained) {
            Result::updateOrCreate(
                [
                    'exam_id' => $request->exam_id,
                    'student_id' => $studentId,
                    'subject_id' => $request->subject_id,
                ],
                [
                    'marks_obtained' => $marksObtained,
                    'total_marks' => $request->total_marks,
                ]
            );
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Marks saved successfully.');
    }

    // Admin: kisi exam ke sab results dekhna
    public function manage(Exam $exam)
    {
        $exam->load(['classRoom.students.user', 'classRoom.subjects']);
        $results = Result::where('exam_id', $exam->id)->get()->groupBy('student_id');

        return view('admin.exams.results', compact('exam', 'results'));
    }
}
