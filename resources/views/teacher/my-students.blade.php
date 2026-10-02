@extends('layouts.app')

@section('title', 'My Students')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">My Students</h5>
        <p class="text-muted small mb-0">Students enrolled in your assigned classes</p>
    </div>

    @forelse ($classes as $class)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid #eee;">
                <h6 class="fw-bold mb-0">{{ $class->class_name }} - {{ $class->section }}</h6>
                <span class="badge bg-light text-dark border">{{ $class->students->count() }} student(s)</span>
            </div>
            <div class="card-body p-0">
                @if ($class->students->isEmpty())
                    <p class="text-muted text-center py-4 mb-0">No students enrolled in this class yet.</p>
                @else
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="ps-4">Roll No.</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th class="pe-4">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class->students as $student)
                                <tr>
                                    <td class="ps-4">{{ $student->roll_number }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td class="pe-4">{{ $student->user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted py-4">You are not assigned to any class yet.</div>
        </div>
    @endforelse

@endsection