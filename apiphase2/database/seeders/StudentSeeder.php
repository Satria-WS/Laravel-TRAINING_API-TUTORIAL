<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {

            // Student::created([
            DB::table("students")->insert([
                "name" => $faker->name(),
                "email" => $faker->safeEmail(),
                "password" => Hash::make($faker->password()),
                "phone_no" => $faker->phoneNumber()
            ]);
        }
    }
}
