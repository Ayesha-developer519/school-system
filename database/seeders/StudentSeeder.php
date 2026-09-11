<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;


class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Ali Raza', 'email' => 'ali@student.com', 'class' => '9th-A', 'roll' => 1, 'father' => 'Raza Ahmed', 'gender' => 'male'],
            ['name' => 'Sara Khan', 'email' => 'sara@student.com', 'class' => '9th-A', 'roll' => 2, 'father' => 'Imran Khan', 'gender' => 'female'],
            ['name' => 'Bilal Ahmed', 'email' => 'bilal@student.com', 'class' => '9th-B', 'roll' => 1, 'father' => 'Ahmed Sheikh', 'gender' => 'male'],
            ['name' => 'Ayesha Noor', 'email' => 'ayesha@student.com', 'class' => '10th-A', 'roll' => 1, 'father' => 'Noor Muhammad', 'gender' => 'female'],
            ['name' => 'Hamza Tariq', 'email' => 'hamza@student.com', 'class' => '10th-A', 'roll' => 2, 'father' => 'Tariq Mehmood', 'gender' => 'male'],
        ];

        foreach ($students as $s) {
            [$className, $section] = explode('-', $s['class']);

            $classRoom = ClassRoom::where('class_name', $className)
                ->where('section', $section)
                ->first();

            $user = User::create([
                'name' => $s['name'],
                'email' => $s['email'],
                'password' => Hash::make('student123'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'class_id' => $classRoom->id,
                'roll_number' => $s['roll'],
                'father_name' => $s['father'],
                'gender' => $s['gender'],
                'dob' => '2010-01-15',
                'admission_date' => now(),
            ]);
        }
    }
}
