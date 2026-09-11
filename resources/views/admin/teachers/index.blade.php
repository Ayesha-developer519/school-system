@extends('layouts.app')

@section('title', 'Teachers')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Teachers</h5>
            <p class="text-muted small mb-0">Manage all teaching staff</p>
        </div>
        <a href="{{ route('teachers.create') }}" class="btn" style="background:#1a9c6d;color:#fff;">
            <i class="bi bi-plus-lg"></i> Add Teacher
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Qualification</th>
                        <th>Specialization</th>
                        <th>Classes</th>
                        <th>Joining Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td class="ps-4">{{ $teacher->user->name }}</td>
                            <td>{{ $teacher->user->email }}</td>
                            <td>{{ $teacher->qualification ?: '—' }}</td>
                            <td>{{ $teacher->subject_specialization ?: '—' }}</td>
                            <td>
                                @forelse ($teacher->classes as $class)
                                    <span class="badge bg-light text-dark border">{{ $class->class_name }}-{{ $class->section }}</span>
                                @empty
                                    <span class="text-muted small">—</span>
                                @endforelse
                            </td>
                            <td>{{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M, Y') }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No teachers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection