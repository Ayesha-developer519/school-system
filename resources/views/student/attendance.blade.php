@extends('layouts.app')

@section('title', 'My Attendance')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">My Attendance</h5>
        <p class="text-muted small mb-0">Your attendance record so far</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-1">Attendance Percentage</p>
                    <h4 class="fw-bold mb-0">{{ $percentage }}%</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-1">Days Present</p>
                    <h4 class="fw-bold mb-0">{{ $presentDays }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-1">Total Days Recorded</p>
                    <h4 class="fw-bold mb-0">{{ $totalDays }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($records->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No attendance records yet.</p>
            @else
                <table class="table align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="ps-4">{{ \Carbon\Carbon::parse($record->date)->format('d M, Y') }}</td>
                                <td class="pe-4">
                                    @if ($record->status == 'present')
                                        <span class="badge bg-success">Present</span>
                                    @elseif ($record->status == 'absent')
                                        <span class="badge bg-danger">Absent</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Leave</span>
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