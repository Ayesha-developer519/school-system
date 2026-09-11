<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Kamran Sheikh',
                'email' => 'kamran@teacher.com',
                'qualification' => 'M.Sc Mathematics',
                'subject' => 'Mathematics',
                'classes' => ['9th-A', '10th-A'],
            ],
            [
                'name' => 'Farah Iqbal',
                'email' => 'farah@teacher.com',
                'qualification' => 'M.A English',
                'subject' => 'English',
                'classes' => ['9th-B'],
            ],
        ];

        foreach ($teachers as $t) {
            $user = User::create([
                'name' => $t['name'],
                'email' => $t['email'],
                'password' => Hash::make('teacher123'),
                'role' => 'teacher',
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'qualification' => $t['qualification'],
                'subject_specialization' => $t['subject'],
                'joining_date' => now(),
            ]);

            $classIds = collect($t['classes'])->map(function ($classKey) {
                [$className, $section] = explode('-', $classKey);
                return ClassRoom::where('class_name', $className)
                    ->where('section', $section)
                    ->first()?->id;
            })->filter()->toArray();

            $teacher->classes()->sync($classIds);
        }
    }
}
