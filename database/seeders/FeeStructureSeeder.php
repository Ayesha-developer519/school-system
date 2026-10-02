<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeeStructure;
use App\Models\ClassRoom;

class FeeStructureSeeder extends Seeder
{
    public function run(): void
    {
        $feeByLevel = [
            'PG' => 2000, 'Nursery' => 2000, 'KG' => 2500,
            '1st' => 3000, '2nd' => 3000, '3rd' => 3000, '4th' => 3500, '5th' => 3500,
            '6th' => 4000, '7th' => 4000, '8th' => 4500, '9th' => 5000, '10th' => 6000,
        ];

        $classes = ClassRoom::all();

        foreach ($classes as $class) {
            $amount = $feeByLevel[$class->class_name] ?? 4000;

            FeeStructure::create([
                'class_id' => $class->id,
                'amount' => $amount,
            ]);
        }
    }
}