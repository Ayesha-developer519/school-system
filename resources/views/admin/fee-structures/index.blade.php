@extends('layouts.app')

@section('title', 'Fee Structure')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Fee Structure</h5>
            <p class="text-muted small mb-0">Select a class to set its monthly fee</p>
        </div>
        <a href="{{ route('fee-payments.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-cash-coin"></i> Manage Fee Payments
        </a>
    </div>

    <div class="row g-3">
        @forelse ($classes as $class)
            <div class="col-md-4">
                <a href="{{ route('fee-structures.by-class', $class->id) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $class->class_name }} - {{ $class->section }}</h6>
                                <p class="text-muted small mb-0">
                                    @if ($class->feeStructure)
                                        Rs. {{ number_format($class->feeStructure->amount, 0) }} / month
                                    @else
                                        <span class="text-danger">Not set</span>
                                    @endif
                                </p>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                                <i class="bi bi-cash-coin text-success"></i>
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