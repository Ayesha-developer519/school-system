@extends('layouts.app')

@section('title', 'Parent Dashboard')

@section('content')

    <h4 class="mb-1">Welcome, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Here's a summary of your child's attendance, results, and fee status.</p>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Child's Attendance</p>
                            <h4 class="fw-bold mb-0">0%</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-calendar-check text-success"></i>
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
                            <p class="text-muted small mb-1">Latest Result</p>
                            <h4 class="fw-bold mb-0">—</h4>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                            <i class="bi bi-journal-text text-success"></i>
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
                            <p class="text-muted small mb-1">Fee Status</p>
                            <h4 class="fw-bold mb-0">
                                <span class="badge bg-warning text-dark">Pending</span>
                            </h4>
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
            <h6 class="fw-bold mb-3">Announcements</h6>
            <p class="text-muted small mb-0">No announcements yet.</p>
        </div>
    </div>

@endsection