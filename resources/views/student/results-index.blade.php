@extends('layouts.app')

@section('title', 'My Results')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">My Results</h5>
        <p class="text-muted small mb-0">Select an exam to view your result</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($exams->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No exams found for your class yet.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Exam Name</th>
                            <th>Exam Date</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                            <tr>
                                <td class="ps-4">{{ $exam->exam_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M, Y') }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('student.results.show', $exam->id) }}" class="btn btn-sm btn-outline-primary">View Result</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection