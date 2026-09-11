@extends('layouts.app')

@section('title', 'Students')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Students</h5>
            <p class="text-muted small mb-0">Manage all enrolled students, grouped by class</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn" style="background:#1a9c6d;color:#fff;">
            <i class="bi bi-plus-lg"></i> Add Student
        </a>
    </div>

    @forelse ($classes as $class)
        @if ($class->students->count() > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid #eee;">
                    <h6 class="fw-bold mb-0">{{ $class->class_name }} - {{ $class->section }}</h6>
                    <span class="badge bg-light text-dark border">{{ $class->students->count() }} student(s)</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="ps-4">Roll No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Father Name</th>
                                <th>Admission Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class->students as $student)
                                <tr>
                                    <td class="ps-4">{{ $student->roll_number }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($student->admission_date)->format('d M, Y') }}</td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @empty
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">No classes found.</div>
        </div>
    @endforelse

    @if ($classes->every(fn($class) => $class->students->count() === 0))
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">No students found.</div>
        </div>
    @endif

@endsection