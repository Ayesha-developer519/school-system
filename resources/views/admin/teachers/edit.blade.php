@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Edit Teacher</h5>
            <p class="text-muted small mb-0">Update teacher information</p>
        </div>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                @csrf
                @method('PUT')

                <h6 class="fw-bold mb-3 text-muted">Account Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->user->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->user->email) }}" required>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3 text-muted">Professional Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $teacher->qualification) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Subject Specialization</label>
                        <input type="text" name="subject_specialization" class="form-control" value="{{ old('subject_specialization', $teacher->subject_specialization) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $teacher->joining_date) }}" required>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label small">Classes Assigned</label>
                    <div class="d-flex flex-wrap gap-3 border rounded p-3">
                        @php
                            $assignedIds = old('classes', $teacher->classes->pluck('id')->toArray());
                        @endphp
                        @foreach ($classes as $class)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="classes[]" value="{{ $class->id }}" id="class{{ $class->id }}"
                                    {{ in_array($class->id, $assignedIds) ? 'checked' : '' }}>
                                <label class="form-check-label small" for="class{{ $class->id }}">
                                    {{ $class->class_name }} - {{ $class->section }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn mt-2" style="background:#1a9c6d;color:#fff;">Update Teacher</button>
            </form>

        </div>
    </div>

@endsection