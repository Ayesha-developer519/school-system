@extends('layouts.app')

@section('title', 'Fee Structure')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">Set or update the monthly fee for this class</p>
        </div>
        <a href="{{ route('fee-structures.index') }}" class="btn btn-outline-secondary btn-sm">Back to Classes</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <p class="text-muted small mb-3">
                Current Monthly Fee:
                @if ($classRoom->feeStructure)
                    <span class="badge bg-light text-dark border">Rs. {{ number_format($classRoom->feeStructure->amount, 0) }}</span>
                @else
                    <span class="text-danger">Not set</span>
                @endif
            </p>

            <form method="POST" action="{{ route('fee-structures.store') }}" class="d-flex gap-2">
                @csrf
                <input type="hidden" name="class_id" value="{{ $classRoom->id }}">
                <input type="number" name="amount" class="form-control" style="max-width: 250px;"
                    placeholder="Amount" min="0" step="0.01"
                    value="{{ $classRoom->feeStructure->amount ?? '' }}" required>
                <button type="submit" class="btn" style="background:#1a9c6d;color:#fff;">Save</button>
            </form>

        </div>
    </div>

@endsection