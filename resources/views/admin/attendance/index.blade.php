@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Attendance</h5>
        <p class="text-muted small mb-0">Select a class to view its attendance records</p>
    </div>

    <div class="row g-3">
        @forelse ($classes as $class)
            <div class="col-md-4">
                <a href="{{ route('admin.attendance.by-class', $class->id) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $class->class_name }} - {{ $class->section }}</h6>
                                <p class="text-muted small mb-0">{{ $class->students_count }} student(s)</p>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                                <i class="bi bi-calendar-check text-success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted py-4">No classes found.</div>
                </div>
            </div>
        @endforelse
    </div>

@endsection