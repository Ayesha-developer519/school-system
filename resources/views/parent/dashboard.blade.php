@extends('layouts.app')

@section('title', 'Parent Dashboard')

@section('content')

    <h4 class="mb-1">Welcome, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-4">Here's a summary of your children.</p>

    @if ($summaries->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">No children linked to your account yet.</div>
        </div>
    @else
        <div class="row g-3">
            @foreach ($summaries as $summary)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">{{ $summary['child']->user->name }}</h6>
                            <p class="text-muted small mb-3">
                                {{ $summary['child']->classRoom->class_name }} - {{ $summary['child']->classRoom->section }}
                            </p>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Attendance</span>
                                <span class="fw-semibold">{{ $summary['attendancePercentage'] }}%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted small">Latest Fee Status</span>
                                <span class="badge {{ $summary['feeStatus'] == 'paid' ? 'bg-success' : ($summary['feeStatus'] == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ ucfirst($summary['feeStatus']) }}
                                </span>
                            </div>

                            <a href="{{ route('parent.children') }}" class="btn btn-sm btn-outline-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection