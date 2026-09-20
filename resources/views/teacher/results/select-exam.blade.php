@extends('layouts.app')

@section('title', 'Enter Marks')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Enter Marks</h5>
        <p class="text-muted small mb-0">Select an exam to enter subject-wise marks</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($exams->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No exams scheduled for your classes yet.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Exam Name</th>
                            <th>Class</th>
                            <th>Exam Date</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                            <tr>
                                <td class="ps-4">{{ $exam->exam_name }}</td>
                                <td>{{ $exam->classRoom->class_name }} - {{ $exam->classRoom->section }}</td>
                                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M, Y') }}</td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm" style="background:#1a9c6d;color:#fff;"
                                        data-bs-toggle="modal" data-bs-target="#subjectModal{{ $exam->id }}">
                                        Select Subject
                                    </button>
                                </td>
                            </tr>

                            {{-- Subject select modal --}}
                            <div class="modal fade" id="subjectModal{{ $exam->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="GET" action="{{ route('results.mark') }}">
                                            <div class="modal-header">
                                                <h6 class="modal-title fw-bold">Select Subject — {{ $exam->exam_name }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                                <label class="form-label small">Subject</label>
                                                <select name="subject_id" class="form-select" required>
                                                    <option value="">-- Select Subject --</option>
                                                    @foreach ($exam->classRoom->subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn" style="background:#1a9c6d;color:#fff;">Continue</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection