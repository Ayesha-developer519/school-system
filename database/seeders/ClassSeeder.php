<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $singleSectionClasses = ['PG', 'Nursery', 'KG', '1st', '2nd', '3rd', '4th', '5th'];
        $doubleSectionClasses = ['6th', '7th', '8th', '9th', '10th'];

        foreach ($singleSectionClasses as $className) {
            ClassRoom::create([
                'class_name' => $className,
                'section' => 'A',
            ]);
        }

        foreach ($doubleSectionClasses as $className) {
            ClassRoom::create(['class_name' => $className, 'section' => 'A']);
            ClassRoom::create(['class_name' => $className, 'section' => 'B']);
        }
    }
}