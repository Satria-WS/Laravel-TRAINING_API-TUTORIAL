<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

// MAKING DATA SEEDER
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    // ID , name , email , password, phone_no

    {
        return [
            "name" => $this->faker->name(),
            "email" => $this->faker->safeEmail(),
            "password" => Hash::make($this->faker->password()),
            "phone_no" => $this->faker->phoneNumber
        ];
    }
}
