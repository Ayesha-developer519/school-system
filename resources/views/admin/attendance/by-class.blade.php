@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">Attendance for {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-secondary btn-sm">Back to Classes</a>
            <form method="GET" action="{{ route('admin.attendance.by-class', $classRoom->id) }}" class="d-flex gap-2">
                <input type="date" name="date" class="form-control form-control-sm" value="{{ $date }}">
                <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($classRoom->students->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No students enrolled in this class.</p>
            @else
                @php
                    $presentCount = $records->where('status', 'present')->count();
                    $absentCount = $records->where('status', 'absent')->count();
                    $leaveCount = $records->where('status', 'leave')->count();
                @endphp

                <div class="d-flex gap-4 px-4 pt-4 pb-2">
                    <div class="small"><span class="badge bg-success">&nbsp;</span> Present: {{ $presentCount }}</div>
                    <div class="small"><span class="badge bg-danger">&nbsp;</span> Absent: {{ $absentCount }}</div>
                    <div class="small"><span class="badge bg-warning">&nbsp;</span> Leave: {{ $leaveCount }}</div>
                </div>

                <table class="table align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Roll No.</th>
                            <th>Name</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classRoom->students as $student)
                            @php
                                $status = $records[$student->id]->status ?? null;
                            @endphp
                            <tr>
                                <td class="ps-4">{{ $student->roll_number }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td class="pe-4">
                                    @if ($status == 'present')
                                        <span class="badge bg-success">Present</span>
                                    @elseif ($status == 'absent')
                                        <span class="badge bg-danger">Absent</span>
                                    @elseif ($status == 'leave')
                                        <span class="badge bg-warning text-dark">Leave</span>
                                    @else
                                        <span class="badge bg-light text-muted border">Not Marked</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection