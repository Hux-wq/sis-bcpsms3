<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ccs 1
        Program::create([
            'id' => 1,
            'code' => 'bsit',
            'name' => 'bachelor of science in information technology',
            'created_by' => 'admin',
            'department_id' => 1,
        ]);
        //ccs 2
        Program::create([
            'id' => 2,
            'code' => 'bsce',
            'name' => 'bachelor of science in computer engineering',
            'created_by' => 'admin',
            'department_id' => 1,
        ]);
        //cba 1
        Program::create([
            'id' => 3,
            'code' => 'bsais',
            'name' => 'Bachelor of science accounting information system',
            'created_by' => 'admin',
            'department_id' => 3,
        ]);
        //clis 1
        Program::create([
            'id' => 4,
            'code' => 'blis',
            'name' => 'Bachelor in library information science',
            'created_by' => 'admin',
            'department_id' => 2,
        ]);
    }
}
