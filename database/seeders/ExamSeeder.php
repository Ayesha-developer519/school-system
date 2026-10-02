<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\ClassRoom;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ClassRoom::all();

        foreach ($classes as $class) {
            Exam::create([
                'class_id' => $class->id,
                'exam_name' => 'Firstterm',
                'exam_date' => now()->subMonths(3),
            ]);

            Exam::create([
                'class_id' => $class->id,
                'exam_name' => 'Final',
                'exam_date' => now()->subDays(10),
            ]);
        }
    }
}