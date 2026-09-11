@extends('layouts.app')

@section('title', 'Class Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Class Details</h5>
            <p class="text-muted small mb-0">Class information and enrolled students</p>
        </div>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3 text-muted">Class Information</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Class Name</p>
                    <p class="mb-0">{{ $classRoom->class_name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Section</p>
                    <p class="mb-0">{{ $classRoom->section }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Total Students</p>
                    <p class="mb-0">{{ $classRoom->students->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <h6 class="fw-bold px-4 pt-4 mb-3 text-muted">Enrolled Students</h6>
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th class="ps-4">Roll No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="pe-4">Father Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classRoom->students as $student)
                        <tr>
                            <td class="ps-4">{{ $student->roll_number }}</td>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td class="pe-4">{{ $student->father_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No students enrolled in this class yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection