<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserNameInfo;
class UserNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        UserNameInfo::create([
            'first_name' => 'mark',
            'middle_name' => 'dean',
            'last_name' => 'marquez',
            'suffix_name' => null,
            'user_id' => 2,
        ]);
    }
}
