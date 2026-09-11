@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Teacher Details</h5>
            <p class="text-muted small mb-0">Full profile information</p>
        </div>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h6 class="fw-bold mb-3 text-muted">Account Details</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Full Name</p>
                    <p class="mb-0">{{ $teacher->user->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Email</p>
                    <p class="mb-0">{{ $teacher->user->email }}</p>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3 text-muted mt-4">Professional Details</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Qualification</p>
                    <p class="mb-0">{{ $teacher->qualification ?: '—' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Subject Specialization</p>
                    <p class="mb-0">{{ $teacher->subject_specialization ?: '—' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted small mb-1">Joining Date</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M, Y') }}</p>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3 text-muted mt-4">Classes Assigned</h6>
            <div class="d-flex flex-wrap gap-2">
                @forelse ($teacher->classes as $class)
                    <span class="badge bg-light text-dark border px-3 py-2">{{ $class->class_name }} - {{ $class->section }}</span>
                @empty
                    <p class="text-muted small mb-0">No classes assigned yet.</p>
                @endforelse
            </div>

        </div>
    </div>

@endsection