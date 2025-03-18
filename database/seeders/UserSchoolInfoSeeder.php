<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSchoolInfo;

class UserSchoolInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 3,
            'section_id' => 1,
            'current_year' => 2025,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);
        
    }
}
