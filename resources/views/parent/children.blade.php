@extends('layouts.app')

@section('title', 'My Children')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">My Children</h5>
        <p class="text-muted small mb-0">Select a child to view attendance, results and fee status</p>
    </div>

    @if ($children->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">No children linked to your account yet.</div>
        </div>
    @else
        <div class="row g-3">
            @foreach ($children as $child)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">{{ $child->user->name }}</h6>
                            <p class="text-muted small mb-3">
                                {{ $child->classRoom->class_name }} - {{ $child->classRoom->section }} | Roll No. {{ $child->roll_number }}
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('parent.attendance', $child->id) }}" class="btn btn-sm btn-outline-secondary">Attendance</a>
                                <a href="{{ route('parent.results.index', $child->id) }}" class="btn btn-sm btn-outline-secondary">Results</a>
                                <a href="{{ route('parent.fees', $child->id) }}" class="btn btn-sm btn-outline-secondary">Fee Status</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection