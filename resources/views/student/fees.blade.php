@extends('layouts.app')

@section('title', 'Fee Status')

@section('content')

    <div class="mb-4">
        <h5 class="fw-bold mb-1">Fee Status</h5>
        <p class="text-muted small mb-0">Your fee payment history</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <p class="text-muted small mb-1">Monthly Fee</p>
            <h4 class="fw-bold mb-0">
                @if ($student->classRoom->feeStructure)
                    Rs. {{ number_format($student->classRoom->feeStructure->amount, 0) }}
                @else
                    <span class="text-muted">Not set</span>
                @endif
            </h4>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($payments->isEmpty())
                <p class="text-muted text-center py-4 mb-0">No fee records found.</p>
            @else
                <table class="table align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4">Month</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
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