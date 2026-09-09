@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <h4 class="mb-1">Welcome, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Here's an overview of your school.</p>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Students</p>
                            <h4 class="fw-bold mb-0">{{ $totalStudents }}</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-people text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Teachers</p>
                            <h4 class="fw-bold mb-0">{{ $totalTeachers }}</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-person-badge text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Classes</p>
                            <h4 class="fw-bold mb-0">{{ $totalClasses }}</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-collection text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Fee Collected</p>
                            <h4 class="fw-bold mb-0">Rs. 0</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-cash-coin text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Recent Activity</h6>
            <p class="text-muted small mb-0">No activity yet — once the Students, Attendance, and Fees modules are built, data will appear here.</p>
        </div>
    </div>

@endsection