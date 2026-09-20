@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Subjects</h5>
            <p class="text-muted small mb-0">Select a class to view its subjects</p>
        </div>
        <a href="{{ route('subjects.create') }}" class="btn" style="background:#1a9c6d;color:#fff;">
            <i class="bi bi-plus-lg"></i> Add Subject
        </a>
    </div>

    <div class="row g-3">
        @forelse ($classes as $class)
            <div class="col-md-4">
                <a href="{{ route('subjects.by-class', $class->id) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $class->class_name }} - {{ $class->section }}</h6>
                                <p class="text-muted small mb-0">{{ $class->subjects_count }} subject(s)</p>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:45px;height:45px;background:#eafaf3;">
                                <i class="bi bi-book text-success"></i>
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