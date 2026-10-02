<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ClassRoom::with('students', 'teachers')->get();

        foreach ($classes as $class) {
            $teacher = $class->teachers->first();
            if (!$teacher) {
                continue;
            }

            for ($i = 0; $i < 10; $i++) {
                $date = now()->subDays($i);

                foreach ($class->students as $student) {
                    $status = collect(['present', 'present', 'present', 'absent', 'leave'])->random();

                    Attendance::create([
                        'student_id' => $student->id,
                        'class_id' => $class->id,
                        'marked_by' => $teacher->id,
                        'date' => $date->toDateString(),
                        'status' => $status,
                    ]);
                }
            }
        }
    }
}