@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')

    <h4 class="mb-1">Welcome, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Here's a summary of your classes and students.</p>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">My Classes</p>
                            <h4 class="fw-bold mb-0">{{ $totalClasses }}</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-collection text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">My Students</p>
                            <h4 class="fw-bold mb-0">{{ $totalStudents }}</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-people text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Today's Attendance</p>
                            <h4 class="fw-bold mb-0">
                                @if ($todayMarked)
                                    <span class="badge bg-success">Marked</span>
                                @else
                                    <span class="badge bg-warning text-dark">Not marked</span>
                                @endif
                            </h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-calendar-check text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Quick Actions</h6>
            <div class="d-flex gap-2">
                <a href="{{ route('attendance.select') }}" class="btn btn-sm" style="background:#1a9c6d;color:#fff;">Mark Attendance</a>
                <a href="{{ route('results.select') }}" class="btn btn-sm btn-outline-secondary">Enter Marks</a>
            </div>
        </div>
    </div>

@endsection