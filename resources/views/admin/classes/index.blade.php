@extends('layouts.app')

@section('title', 'Classes')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Classes</h5>
            <p class="text-muted small mb-0">Manage school classes and sections</p>
        </div>
        <a href="{{ route('classes.create') }}" class="btn" style="background:#1a9c6d;color:#fff;">
            <i class="bi bi-plus-lg"></i> Add Class
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th class="ps-4">Class Name</th>
                        <th>Section</th>
                        <th>Total Students</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classes as $class)
                        <tr>
                            <td class="ps-4">{{ $class->class_name }}</td>
                            <td>{{ $class->section }}</td>
                            <td>{{ $class->students_count }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('classes.show', $class->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this class?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No classes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection