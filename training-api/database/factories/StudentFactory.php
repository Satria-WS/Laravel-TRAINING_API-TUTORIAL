<?php

namespace Database\Factories;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //write this code
            "name" => $this->faker->name(),
            "email"=> $this->faker-> safeEmail(),
            "phone_no" =>$this->faker->phoneNumber,
            "age"=> $this->faker->numberBetween(25,45),
            "gender" => $this->faker->randomElement([
                "male",
                "female",
            ]),

        ];
    }
}
