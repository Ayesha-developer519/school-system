@extends('layouts.app')

@section('title', 'Result')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $exam->exam_name }} — Result</h5>
            <p class="text-muted small mb-0">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M, Y') }}</p>
        </div>
        <a href="{{ route('student.results.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($results->isEmpty())
                <p class="text-muted text-center py-4 mb-0">Results not announced yet for this exam.</p>
            @else
                <table class="table align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Subject</th>
                            <th class="pe-4">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td class="ps-4">{{ $result->subject->subject_name }}</td>
                                <td class="pe-4">{{ $result->marks_obtained }} / {{ $result->total_marks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background:#f8f9fa;">
                            <td class="ps-4 fw-bold">Overall Percentage</td>
                            <td class="pe-4 fw-bold">{{ $overallPercentage }}%</td>
                        </tr>
                    </tfoot>
                </table>
            @endif
        </div>
    </div>

@endsection