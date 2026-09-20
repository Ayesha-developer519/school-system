@extends('layouts.app')

@section('title', 'Students')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">{{ $classRoom->students->count() }} student(s) enrolled</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">Back to Classes</a>
            <a href="{{ route('students.create') }}" class="btn btn-sm" style="background:#1a9c6d;color:#fff;">
                <i class="bi bi-plus-lg"></i> Add Student
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($classRoom->students->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No students enrolled in this class yet.</p>
            @else
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
                        @foreach ($classRoom->students as $student)
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
            @endif
        </div>
    </div>

@endsection