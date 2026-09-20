@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">{{ $classRoom->subjects->count() }} subject(s)</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-sm">Back to Classes</a>
            <a href="{{ route('subjects.create') }}" class="btn btn-sm" style="background:#1a9c6d;color:#fff;">
                <i class="bi bi-plus-lg"></i> Add Subject
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($classRoom->subjects->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No subjects added for this class yet.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Subject Name</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classRoom->subjects as $subject)
                            <tr>
                                <td class="ps-4">{{ $subject->subject_name }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subject?');">
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