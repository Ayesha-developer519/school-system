<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeePayment;
use App\Models\ClassRoom;
use App\Models\Student;

class FeePaymentController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::withCount('students')->with('feeStructure')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.fee-payments.index', compact('classes'));
    }

    public function byClass(Request $request, ClassRoom $classRoom)
    {
        $currentMonth = $request->get('month', date('F Y'));

        $classRoom->load(['feeStructure', 'students.user', 'students.feePayments' => function ($query) use ($currentMonth) {
            $query->where('month', $currentMonth);
        }]);

        return view('admin.fee-payments.by-class', compact('classRoom', 'currentMonth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,pending,overdue',
        ]);

        $student = \App\Models\Student::findOrFail($request->student_id);

        FeePayment::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'month' => $request->month,
            ],
            [
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'status' => $request->status,
            ]
        );

        return redirect()->route('fee-payments.by-class', $student->class_id)->with('success', 'Fee record saved successfully.');
    }

    public function show(\App\Models\Student $student)
    {
        $student->load(['user', 'classRoom.feeStructure', 'feePayments' => function ($query) {
            $query->orderByDesc('payment_date');
        }]);

        return view('admin.fee-payments.show', compact('student'));
    }
}