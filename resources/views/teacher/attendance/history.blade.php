@extends('layouts.app')

@section('title', 'Attendance History')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Attendance History</h5>
            <p class="text-muted small mb-0">View past attendance records for your classes</p>
        </div>
        <a href="{{ route('attendance.select') }}" class="btn btn-outline-secondary btn-sm">Back to Attendance</a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('attendance.history') }}">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label small">Select Class</label>
                        <select name="class_id" class="form-select" required>
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }} - {{ $class->section }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label small">Select Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn w-100" style="background:#1a9c6d;color:#fff;">View</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($selectedClass)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid #eee;">
                <h6 class="fw-bold mb-0">{{ $selectedClass->class_name }} - {{ $selectedClass->section }}</h6>
                <span class="text-muted small">{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</span>
            </div>
            <div class="card-body p-0">
                @if ($selectedClass->students->isEmpty())
                    <p class="text-muted text-center py-4 mb-0">No students enrolled in this class.</p>
                @else
                    <table class="table align-middle mb-0">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="ps-4">Roll No.</th>
                                <th>Name</th>
                                <th class="pe-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedClass->students as $student)
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
    @endif

@endsection