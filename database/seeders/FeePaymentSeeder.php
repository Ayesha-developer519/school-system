<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\FeePayment;

class FeePaymentSeeder extends Seeder
{
    public function run(): void
    {
        $months = ['July 2026', 'August 2026', 'September 2026'];
        $students = Student::with('classRoom.feeStructure')->get();

        foreach ($students as $student) {
            $monthlyFee = $student->classRoom->feeStructure->amount ?? 4000;

            foreach ($months as $index => $month) {
                $status = collect(['paid', 'paid', 'paid', 'pending', 'overdue'])->random();
                $amountPaid = $status == 'paid' ? $monthlyFee : ($status == 'pending' ? 0 : $monthlyFee * 0.5);

                FeePayment::create([
                    'student_id' => $student->id,
                    'month' => $month,
                    'amount_paid' => $amountPaid,
                    'payment_date' => now()->subMonths(3 - $index),
                    'status' => $status,
                ]);
            }
        }
    }
}