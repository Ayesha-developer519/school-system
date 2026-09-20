@extends('layouts.app')

@section('title', 'Exam Results')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $exam->exam_name }} — Results</h5>
            <p class="text-muted small mb-0">{{ $exam->classRoom->class_name }} - {{ $exam->classRoom->section }}</p>
        </div>
        <a href="{{ route('exams.index') }}" class="btn btn-outline-secondary btn-sm">Back to Exams</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            @if ($exam->classRoom->subjects->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No subjects added for this class yet.</p>
            @elseif ($exam->classRoom->students->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No students enrolled in this class.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Roll No.</th>
                            <th>Name</th>
                            @foreach ($exam->classRoom->subjects as $subject)
                                <th class="text-center">{{ $subject->subject_name }}</th>
                            @endforeach
                            <th class="text-center pe-4">Overall %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam->classRoom->students as $student)
                            @php
                                $studentResults = $results[$student->id] ?? collect();
                                $totalObtained = $studentResults->sum('marks_obtained');
                                $totalMax = $studentResults->sum('total_marks');
                                $overallPercentage = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : null;
                            @endphp
                            <tr>
                                <td class="ps-4">{{ $student->roll_number }}</td>
                                <td>{{ $student->user->name }}</td>
                                @foreach ($exam->classRoom->subjects as $subject)
                                    @php
                                        $result = $studentResults->firstWhere('subject_id', $subject->id);
                                    @endphp
                                    <td class="text-center">
                                        @if ($result)
                                            {{ $result->marks_obtained }}/{{ $result->total_marks }}
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="text-center pe-4">
                                    @if ($overallPercentage !== null)
                                        <span class="badge bg-light text-dark border">{{ $overallPercentage }}%</span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

@endsection