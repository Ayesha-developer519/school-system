@extends('layouts.app')

@section('title', 'Mark Attendance')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">Marking attendance for {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</p>
        </div>
        <a href="{{ route('attendance.select') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if ($classRoom->students->isEmpty())
                <p class="text-muted mb-0">No students enrolled in this class.</p>
            @else
                <form method="POST" action="{{ route('attendance.store') }}">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $classRoom->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <table class="table align-middle mb-4">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="ps-3">Roll No.</th>
                                <th>Name</th>
                                <th class="text-center">Present</th>
                                <th class="text-center">Absent</th>
                                <th class="text-center">Leave</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classRoom->students as $student)
                                @php
                                    $currentStatus = $existingAttendance[$student->id] ?? 'present';
                                @endphp
                                <tr>
                                    <td class="ps-3">{{ $student->roll_number }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td class="text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="present"
                                            {{ $currentStatus == 'present' ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="absent"
                                            {{ $currentStatus == 'absent' ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="leave"
                                            {{ $currentStatus == 'leave' ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn" style="background:#1a9c6d;color:#fff;">Save Attendance</button>
                </form>
            @endif

        </div>
    </div>

@endsection