@extends('layouts.app')

@section('title', 'Add Class')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Add Class</h5>
            <p class="text-muted small mb-0">Create a new class and section</p>
        </div>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
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

            <form method="POST" action="{{ route('classes.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Class Name</label>
                        <input type="text" name="class_name" class="form-control" value="{{ old('class_name') }}" placeholder="e.g. 9th" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small">Section</label>
                        <input type="text" name="section" class="form-control" value="{{ old('section') }}" placeholder="e.g. A" required>
                    </div>
                </div>

                <button type="submit" class="btn mt-2" style="background:#1a9c6d;color:#fff;">Save Class</button>
            </form>

        </div>
    </div>

@endsection