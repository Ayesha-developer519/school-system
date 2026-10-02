@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Attendance</h5>
        <p class="text-muted small mb-0">Mark today's attendance or view past records</p>
    </div>

    <ul class="nav nav-tabs mb-4" style="border-bottom: 1px solid #dee2e6;">
        <li class="nav-item">
            <button class="nav-link active" id="mark-tab" data-bs-toggle="tab" data-bs-target="#mark-pane" type="button">
                Mark Attendance
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history-pane" type="button">
                History
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- Mark Attendance Tab --}}
        <div class="tab-pane fade show active" id="mark-pane">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    @if ($classes->isEmpty())
                        <p class="text-muted mb-0">You are not assigned to any class yet. Please contact the Admin.</p>
                    @else
                        <form method="GET" action="{{ route('attendance.mark') }}">
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label class="form-label small">Select Class</label>
                                    <div class="dropdown">
                                        <button class="form-select text-start dropdown-toggle-custom" type="button" id="markClassDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span id="markClassSelectedText">-- Select Class --</span>
                                        </button>
                                        <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="markClassDropdownBtn">
                                            @foreach ($classes as $class)
                                                <li><a class="dropdown-item role-item" href="#" data-value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->section }}</a></li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" name="class_id" id="markClassInput" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="form-label small">Select Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-2 mb-3 d-flex align-items-end">
                                    <button type="submit" class="btn w-100" style="background:#1a9c6d;color:#fff;">Continue</button>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>

        {{-- History Tab --}}
        <div class="tab-pane fade" id="history-pane">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('attendance.history') }}">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label small">Select Class</label>
                                <div class="dropdown">
                                    <button class="form-select text-start dropdown-toggle-custom" type="button" id="historyClassDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="historyClassSelectedText">-- Select Class --</span>
                                    </button>
                                    <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="historyClassDropdownBtn">
                                        @foreach ($classes as $class)
                                            <li><a class="dropdown-item role-item" href="#" data-value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->section }}</a></li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="class_id" id="historyClassInput" value="" required>
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label small">Select Date</label>
                                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn w-100" style="background:#1a9c6d;color:#fff;">View</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection