<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\UserBasicInfo;

class UserBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        UserBasicInfo::create([
            'age' => $faker->numberBetween(18, 25),
            'gender' => $faker->randomElement(['male', 'female']),
            'birthdate' => $faker->date(),
            'religion' => 'catholic',
            'place_of_birth' => 'Quezon City',
            'current_address' => 'Quezon City',
            'user_id' => 2,
        ]);
    }
}
