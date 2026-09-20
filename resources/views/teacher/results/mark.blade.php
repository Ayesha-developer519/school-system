@extends('layouts.app')

@section('title', 'Enter Marks')

@section('content')

    @php
        $subjectName = $exam->classRoom->subjects->firstWhere('id', $subjectId)?->subject_name;
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $exam->exam_name }} — {{ $subjectName }}</h5>
            <p class="text-muted small mb-0">{{ $exam->classRoom->class_name }} - {{ $exam->classRoom->section }}</p>
        </div>
        <a href="{{ route('results.select') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if ($exam->classRoom->students->isEmpty())
                <p class="text-muted mb-0">No students enrolled in this class.</p>
            @else
                <form method="POST" action="{{ route('results.store') }}">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <input type="hidden" name="subject_id" value="{{ $subjectId }}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label small">Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" min="1"
                                value="{{ $existingResults->first()->total_marks ?? 100 }}" required>
                        </div>
                    </div>

                    <table class="table align-middle mb-4">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="ps-3">Roll No.</th>
                                <th>Name</th>
                                <th style="width: 150px;">Marks Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam->classRoom->students as $student)
                                <tr>
                                    <td class="ps-3">{{ $student->roll_number }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>
                                        <input type="number" name="marks[{{ $student->id }}]" class="form-control" min="0"
                                            value="{{ $existingResults[$student->id]->marks_obtained ?? '' }}" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn" style="background:#1a9c6d;color:#fff;">Save Marks</button>
                </form>
            @endif

        </div>
    </div>

@endsection