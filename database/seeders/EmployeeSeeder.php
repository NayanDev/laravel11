<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Employee::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['L', 'P']),
                'department_id' => $faker->numberBetween(1, 3),
                'position_id' => $faker->numberBetween(1, 3),
                'qualification_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
