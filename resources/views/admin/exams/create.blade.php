@extends('layouts.app')

@section('title', 'Add Exam')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Add Exam</h5>
            <p class="text-muted small mb-0">Schedule a new exam for a class</p>
        </div>
        <a href="{{ route('exams.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('exams.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label small">Class</label>
                        <div class="dropdown">
                            <button class="form-select text-start dropdown-toggle-custom" type="button" id="classDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="classSelectedText">-- Select Class --</span>
                            </button>
                            <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="classDropdownBtn">
                                @foreach ($classes as $class)
                                    <li><a class="dropdown-item role-item" href="#" data-value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->section }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="class_id" id="classInput" value="{{ old('class_id') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label small">Exam Name</label>
                        <div class="dropdown">
                            <button class="form-select text-start dropdown-toggle-custom" type="button" id="examDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="examSelectedText">-- Select Exam --</span>
                            </button>
                            <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="examDropdownBtn">
                                <li><a class="dropdown-item role-item" href="#" data-value="Firstterm">Firstterm</a></li>
                                <li><a class="dropdown-item role-item" href="#" data-value="Secondterm">Secondterm</a></li>
                                <li><a class="dropdown-item role-item" href="#" data-value="Final">Final</a></li>
                            </ul>
                            <input type="hidden" name="exam_name" id="examInput" value="{{ old('exam_name') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label small">Exam Date</label>
                        <input type="date" name="exam_date" class="form-control" value="{{ old('exam_date') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn mt-2" style="background:#1a9c6d;color:#fff;">Save Exam</button>
            </form>

        </div>
    </div>

@endsection