<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teacherNames = [
            ['name' => 'Kamran Sheikh', 'qualification' => 'M.Sc Mathematics', 'subject' => 'Mathematics'],
            ['name' => 'Farah Iqbal', 'qualification' => 'M.A English', 'subject' => 'English'],
            ['name' => 'Imran Yousaf', 'qualification' => 'M.Sc Physics', 'subject' => 'Science'],
            ['name' => 'Ayesha Malik', 'qualification' => 'M.A Urdu', 'subject' => 'Urdu'],
            ['name' => 'Bilal Anwar', 'qualification' => 'M.A Islamic Studies', 'subject' => 'Islamiat'],
            ['name' => 'Sana Tariq', 'qualification' => 'M.Sc Chemistry', 'subject' => 'Science'],
            ['name' => 'Waqas Ahmed', 'qualification' => 'M.A English', 'subject' => 'English'],
            ['name' => 'Nadia Hussain', 'qualification' => 'M.Sc Mathematics', 'subject' => 'Mathematics'],
            ['name' => 'Tariq Javed', 'qualification' => 'M.A Urdu', 'subject' => 'Urdu'],
            ['name' => 'Hina Shahid', 'qualification' => 'M.A Islamic Studies', 'subject' => 'Islamiat'],
        ];

        $classes = ClassRoom::orderBy('id')->get();
        $classChunks = $classes->chunk(2); // har teacher ko 2 classes assign karenge

        foreach ($teacherNames as $index => $t) {
            $emailSlug = strtolower(str_replace(' ', '.', $t['name']));

            $user = User::create([
                'name' => $t['name'],
                'email' => $emailSlug . '@teacher.com',
                'password' => Hash::make('teacher123'),
                'role' => 'teacher',
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'qualification' => $t['qualification'],
                'subject_specialization' => $t['subject'],
                'joining_date' => now()->subMonths(rand(6, 36)),
            ]);

            $assignedClasses = $classChunks->get($index, collect());
            $teacher->classes()->sync($assignedClasses->pluck('id')->toArray());
        }
    }
}