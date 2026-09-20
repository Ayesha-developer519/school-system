@extends('layouts.app')

@section('title', 'Fee History')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $student->user->name }} — Fee History</h5>
            <p class="text-muted small mb-0">{{ $student->classRoom->class_name }} - {{ $student->classRoom->section }} | Roll No. {{ $student->roll_number }}</p>
        </div>
        <a href="{{ route('fee-payments.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($student->feePayments->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No payment records found.</p>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Month</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->feePayments as $payment)
                            <tr>
                                <td class="ps-4">{{ $payment->month }}</td>
                                <td>Rs. {{ number_format($payment->amount_paid, 0) }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}</td>
                                <td class="pe-4">
                                    @if ($payment->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif ($payment->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Overdue</span>
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