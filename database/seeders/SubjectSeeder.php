<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\ClassRoom;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjectNames = ['Mathematics', 'English', 'Science', 'Urdu', 'Islamiat'];

        $classes = ClassRoom::all();

        foreach ($classes as $class) {
            foreach ($subjectNames as $subjectName) {
                Subject::create([
                    'class_id' => $class->id,
                    'subject_name' => $subjectName,
                ]);
            }
        }
    }
}