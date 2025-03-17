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
            'email_verified_at' => null,
            'password' =>  Hash::make('Admin123?'),
            'account_type' => 'admin',
            'remember_token' => null,
        ]);

        User::create([
            'id' => 2,
            'email' => 'mark.marquez3@student.com',
            'email_verified_at' => null,
            'password' =>  Hash::make('Marquez123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);
    
    }
}
