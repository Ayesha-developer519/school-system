<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeStructure;
use App\Models\ClassRoom;

class FeeStructureController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::with('feeStructure')->orderBy('class_name')->orderBy('section')->get();
        return view('admin.fee-structures.index', compact('classes'));
    }

    public function byClass(ClassRoom $classRoom)
    {
        $classRoom->load('feeStructure');
        return view('admin.fee-structures.by-class', compact('classRoom'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'amount' => 'required|numeric|min:0',
        ]);

        FeeStructure::updateOrCreate(
            ['class_id' => $request->class_id],
            ['amount' => $request->amount]
        );

        return redirect()->route('fee-structures.by-class', $request->class_id)->with('success', 'Fee amount saved successfully.');
    }
}