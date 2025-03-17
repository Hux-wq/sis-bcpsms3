<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserContactInfo;

class UserContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        UserContactInfo::create([
            'phone_number' => 9387161706,
            'email_address' => 'mark.marquez3@student.com',
            'facebook' => 'https://www.facebook.com/marquez',
            'user_id' => 2, 
        ]);
    }
}
