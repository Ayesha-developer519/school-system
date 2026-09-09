@extends('layouts.app')

@section('title', 'Student Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Student Details</h5>
            <p class="text-muted small mb-0">Full profile information</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h6 class="fw-bold mb-3 text-muted">Account Details</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Full Name</p>
                    <p class="mb-0">{{ $student->user->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Email</p>
                    <p class="mb-0">{{ $student->user->email }}</p>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3 text-muted mt-4">Student Details</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Class</p>
                    <p class="mb-0">{{ $student->classRoom->class_name }} - {{ $student->classRoom->section }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Roll Number</p>
                    <p class="mb-0">{{ $student->roll_number }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Father Name</p>
                    <p class="mb-0">{{ $student->father_name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Date of Birth</p>
                    <p class="mb-0">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M, Y') : '—' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Gender</p>
                    <p class="mb-0">{{ $student->gender ? ucfirst($student->gender) : '—' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Admission Date</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($student->admission_date)->format('d M, Y') }}</p>
                </div>
                <div class="col-12 mb-3">
                    <p class="text-muted small mb-1">Address</p>
                    <p class="mb-0">{{ $student->address ?: '—' }}</p>
                </div>
            </div>

        </div>
    </div>

@endsection