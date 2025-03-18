<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'section' => 1,
            'adviser' => 3, 
            'year' => 2024,
            'semester' => 1, 
            'specialization' => 1,
            'created_by' => 'system',
            'department_id' => 1, 
            
        ]);

        Section::create([
            'section' => 2,
            'adviser' => null, 
            'year' => 2024,
            'semester' => 2, 
            'specialization' => 1,
            'created_by' => 'system',
            'department_id' => 1, 
            
        ]);

        Section::create([
            'section' => 3,
            'adviser' => null, 
            'year' => 2024,
            'semester' => 2, 
            'specialization' => 1,
            'created_by' => 'system',
            'department_id' => 2, 
            
        ]);

        Section::create([
            'section' => 4,
            'adviser' => null, 
            'year' => 2024,
            'semester' => 2, 
            'specialization' => 1,
            'created_by' => 'system',
            'department_id' => 3, 
            
        ]);
    }
}
