<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Result;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $exams = Exam::with('classRoom.students', 'classRoom.subjects')->get();

        foreach ($exams as $exam) {
            foreach ($exam->classRoom->students as $student) {
                foreach ($exam->classRoom->subjects as $subject) {
                    Result::create([
                        'exam_id' => $exam->id,
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'marks_obtained' => rand(45, 98),
                        'total_marks' => 100,
                    ]);
                }
            }
        }
    }
}