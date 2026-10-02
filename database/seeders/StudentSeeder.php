<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $firstNamesMale = ['Ali', 'Bilal', 'Usman', 'Hamza', 'Fahad', 'Shahzaib', 'Danish', 'Zeeshan', 'Owais', 'Hassan', 'Talha', 'Faizan'];
        $firstNamesFemale = ['Sara', 'Mahnoor', 'Zainab', 'Areeba', 'Hira', 'Komal', 'Rimsha', 'Ayesha', 'Sidra', 'Mehak', 'Iqra', 'Laiba'];
        $lastNames = ['Ahmed', 'Khan', 'Raza', 'Iqbal', 'Sheikh', 'Malik', 'Hussain', 'Javed', 'Tariq', 'Nasir', 'Mehmood', 'Alam'];

        $classes = ClassRoom::orderBy('id')->get();
        $emailCounter = 1;

        foreach ($classes as $class) {
            for ($roll = 1; $roll <= 2; $roll++) {
                $isMale = rand(0, 1) == 1;
                $firstName = $isMale
                    ? $firstNamesMale[array_rand($firstNamesMale)]
                    : $firstNamesFemale[array_rand($firstNamesFemale)];
                $lastName = $lastNames[array_rand($lastNames)];
                $fullName = "$firstName $lastName";

                $email = strtolower($firstName) . $emailCounter . '@student.com';
                $emailCounter++;

                $user = User::create([
                    'name' => $fullName,
                    'email' => $email,
                    'password' => Hash::make('student123'),
                    'role' => 'student',
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'class_id' => $class->id,
                    'roll_number' => $roll,
                    'father_name' => $lastNames[array_rand($lastNames)] . ' ' . ($isMale ? 'Ahmed' : 'Hussain'),
                    'gender' => $isMale ? 'male' : 'female',
                    'dob' => now()->subYears(rand(4, 16))->subDays(rand(0, 365)),
                    'address' => 'Sheikhupura, Punjab',
                    'admission_date' => now()->subMonths(rand(6, 30)),
                    'invite_code' => 'SMS-' . strtoupper(\Illuminate\Support\Str::random(6)),
                ]);
            }
        }
    }
}