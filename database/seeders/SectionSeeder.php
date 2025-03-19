<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\User;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all departments
        $departments = Department::all();
        
        // Get some users to use as advisers
        // Assuming you have users in the database
        $users = User::all();
        
        // If no users exist, create a default array of IDs
        $userIds = $users->count() > 0 ? $users->pluck('id')->toArray() : [null];
        
        // Years and semesters
        $years = [1, 2, 3, 4];
        $semesters = [1, 2];
        
        // Possible specializations (null or 1-5)
        $specializations = [null, 1, 2, 3, 4, 5];
        
        foreach ($departments as $department) {
            // Create 10 sections for each department with incremental section numbers
            for ($i = 1; $i <= 10; $i++) {
                DB::table('sections')->insert([
                    'section' => $i, // Incremental section number from 1 to 10
                    'adviser' => null, // Randomly select an adviser
                    'semester_year' => null,
                    'semester' => null ,
                    'specialization' => null,
                    'created_by' => 'system',
                    'department_id' => $department->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}