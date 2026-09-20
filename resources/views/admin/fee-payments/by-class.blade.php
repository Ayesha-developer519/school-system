@extends('layouts.app')

@section('title', 'Fee Payments')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $classRoom->class_name }} - {{ $classRoom->section }}</h5>
            <p class="text-muted small mb-0">
                Monthly Fee:
                @if ($classRoom->feeStructure)
                    Rs. {{ number_format($classRoom->feeStructure->amount, 0) }}
                @else
                    <span class="text-danger">Not set</span>
                @endif
                &nbsp;|&nbsp; Showing: <strong>{{ $currentMonth }}</strong>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('fee-payments.index') }}" class="btn btn-outline-secondary btn-sm">Back to Classes</a>
            <form method="GET" action="{{ route('fee-payments.by-class', $classRoom->id) }}" class="d-flex gap-2">
                <input type="text" name="month" class="form-control form-control-sm" style="width: 180px;"
                    value="{{ $currentMonth }}" placeholder="e.g. September 2026">
                <button type="submit" class="btn btn-sm btn-outline-secondary">View Month</button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($classRoom->students->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No students enrolled in this class.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Roll No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classRoom->students as $student)
                            @php
                                $payment = $student->feePayments->first();
                                $monthlyFee = $classRoom->feeStructure->amount ?? 0;
                                $paidAmount = $payment->amount_paid ?? 0;
                                $remaining = max($monthlyFee - $paidAmount, 0);
                            @endphp
                            <tr>
                                <td class="ps-4">{{ $student->roll_number }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>
                                    @if (!$payment)
                                        <span class="badge bg-light text-muted border">Not Recorded</span>
                                    @elseif ($payment->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif ($payment->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Overdue</span>
                                    @endif
                                </td>
                                <td>Rs. {{ number_format($paidAmount, 0) }}</td>
                                <td>
                                    @if ($remaining > 0)
                                        <span class="text-danger">Rs. {{ number_format($remaining, 0) }}</span>
                                    @else
                                        <span class="text-success">Rs. 0</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('fee-payments.show', $student->id) }}" class="btn btn-sm btn-outline-primary">History</a>
                                    <button type="button" class="btn btn-sm" style="background:#1a9c6d;color:#fff;"
                                        data-bs-toggle="modal" data-bs-target="#feeModal{{ $student->id }}">
                                        Record Payment
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="feeModal{{ $student->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('fee-payments.store') }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h6 class="modal-title fw-bold">Record Payment — {{ $student->user->name }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">

                                                <div class="mb-3">
                                                    <label class="form-label small">Month</label>
                                                    <input type="text" name="month" class="form-control" value="{{ $currentMonth }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label small">Amount Paid</label>
                                                    <input type="number" name="amount_paid" class="form-control" min="0" step="0.01"
                                                        value="{{ $payment->amount_paid ?? $monthlyFee }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label small">Payment Date</label>
                                                    <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label small">Status</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="paid" {{ ($payment->status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                                                        <option value="pending" {{ ($payment->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="overdue" {{ ($payment->status ?? '') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn" style="background:#1a9c6d;color:#fff;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection