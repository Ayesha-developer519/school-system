<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Exam;
use App\Models\FeePayment;
use App\Models\Result;
use App\Models\Student;

class ParentController extends Controller
{
    // Parent ke bachon ki list
    public function children()
    {
        $children = auth()->user()->children()->with(['user', 'classRoom'])->get();
        return view('parent.children', compact('children'));
    }

    // Bachay ki attendance
    public function attendance(Student $student)
    {
        $this->authorizeChild($student);

        $records = Attendance::where('student_id', $student->id)->orderByDesc('date')->get();

        $totalDays = $records->count();
        $presentDays = $records->where('status', 'present')->count();
        $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

        return view('parent.attendance', compact('student', 'records', 'percentage', 'totalDays', 'presentDays'));
    }

    // Bachay ke exams ki list
    public function resultsIndex(Student $student)
    {
        $this->authorizeChild($student);

        $exams = Exam::where('class_id', $student->class_id)->latest('exam_date')->get();

        return view('parent.results-index', compact('student', 'exams'));
    }

    // Ek exam ka result
    public function resultShow(Student $student, Exam $exam)
    {
        $this->authorizeChild($student);

        if ($exam->class_id != $student->class_id) {
            abort(403, 'This exam does not belong to your child\'s class.');
        }

        $results = Result::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->with('subject')
            ->get();

        $totalObtained = $results->sum('marks_obtained');
        $totalMax = $results->sum('total_marks');
        $overallPercentage = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : null;

        return view('parent.result-show', compact('student', 'exam', 'results', 'overallPercentage'));
    }

    // Bachay ki fee status
    public function fees(Student $student)
    {
        $this->authorizeChild($student);

        $student->load('classRoom.feeStructure');
        $payments = FeePayment::where('student_id', $student->id)->orderByDesc('payment_date')->get();

        return view('parent.fees', compact('student', 'payments'));
    }

    // Security check: ye student is parent ka bachcha hai ya nahi
    private function authorizeChild(Student $student)
    {
        if ($student->parent_id !== auth()->id()) {
            abort(403, 'You are not authorized to view this student.');
        }
    }
}
