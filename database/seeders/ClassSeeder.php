<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['class_name' => '9th', 'section' => 'A'],
            ['class_name' => '9th', 'section' => 'B'],
            ['class_name' => '10th', 'section' => 'A'],
        ];

        foreach ($classes as $class) {
            ClassRoom::create($class);
        }
    }
}
