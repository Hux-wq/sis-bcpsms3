<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $cities = [
            'Manila', 'Quezon City', 'Davao City', 'Cebu City', 'Baguio',
            'Iloilo City', 'Zamboanga City', 'Taguig', 'Cagayan de Oro', 'Pasig'
        ];

        $religions = [
            'Roman Catholic', 'Islam', 'Iglesia ni Cristo', 'Evangelical',
            'Born Again', 'Buddhism', 'Hinduism'
        ];

        $enrollmentStatuses = ['Enrolled', 
                                'Graduated', 
                                'Transferee', 
                                'Returnee', 
                                'Octoberian', 
                                'Dropped Out', 
                                'Failed'];
        $suffix = [ 'Jr.',
                    'II',
                    'III',
                    ' '];     

        for ($i = 0; $i <= 150; $i++) {
            $birthdate = $faker->dateTimeBetween('-30 years', '-19 years');
            $createdAt = $faker->dateTimeBetween('2025-01-01', now());
            DB::table('students')->insert([
                'student_number'   => '21' . str_pad($faker->unique()->numberBetween(0, 999999), 6, '0', STR_PAD_LEFT),
                'first_name'        => $faker->firstName,
                'middle_name'      => $faker->firstName,
                'last_name'        => $faker->lastName,
                'suffix_name'      => $faker->randomElement($suffix),
                'age'              => Carbon::parse($birthdate)->age,
                'gender'           => $faker->randomElement(['Male', 'Female']),
                'birthdate'        => $birthdate->format('Y-m-d'),
                'religion'         => $faker->randomElement($religions),
                'place_of_birth'   => $faker->randomElement($cities),
                'current_address'  => $faker->address,
                'email_address'    => $faker->unique()->safeEmail,
                'contact_number'   => '09' . $faker->numberBetween(100000000, 999999999),
                'program_id'       => $faker->numberBetween(1, 50),
                'enrollment_status'=> $faker->randomElement($enrollmentStatuses),
                'created_at'       => $createdAt,
                'updated_at'       => now(),
            ]);
        }
    }
}
