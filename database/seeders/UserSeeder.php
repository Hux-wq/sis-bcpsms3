<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
Use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'email' => 'admin@admin.com',
            'account_number' => 1,
            'email_verified_at' => null,
            'password' =>  Hash::make('Admin123?'),
            'account_type' => 'admin',
            'remember_token' => null,
        ]);

        User::create([
            'id' => 2,
            'email' => 'john.smith11@prof.com',
            'account_number' => 2,
            'email_verified_at' => null,
            'password' =>  Hash::make('Smith123?'),
            'account_type' => 'professor',
            'remember_token' => null,
        ]);

        User::create([
            'id' => 3,
            'email' => 'mark.marquez3@student.com',
            'account_number' => 21120454,
            'email_verified_at' => null,
            'password' =>  Hash::make('Marquez123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);


        
    
    
    }
}
