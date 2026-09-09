@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Add Student</h5>
            <p class="text-muted small mb-0">Create a new student account and record</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
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

            <form method="POST" action="{{ route('students.store') }}">
                @csrf

                <h6 class="fw-bold mb-3 text-muted">Account Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control pe-5" required>
                            <i class="bi bi-eye-slash position-absolute" id="password-icon"
                            style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"
                            onclick="togglePassword('password', 'password-icon')"></i>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3 text-muted">Student Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Roll Number</label>
                        <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Father Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Gender</label>
                        <div class="dropdown">
                            <button class="form-select text-start dropdown-toggle-custom" type="button" id="genderDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="genderSelectedText">-- Select Gender --</span>
                            </button>
                            <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="genderDropdownBtn">
                                <li><a class="dropdown-item role-item" href="#" data-value="male">Male</a></li>
                                <li><a class="dropdown-item role-item" href="#" data-value="female">Female</a></li>
                            </ul>
                            <input type="hidden" name="gender" id="genderInput" value="{{ old('gender') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Admission Date</label>
                        <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date') }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label small">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn mt-2" style="background:#1a9c6d;color:#fff;">Save Student</button>
            </form>

        </div>
    </div>

@endsection
