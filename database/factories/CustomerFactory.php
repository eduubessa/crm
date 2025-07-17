<?php

namespace Database\Factories;

use App\Helpers\Interfaces\ICustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'reference' => $this->faker->uuid(),
            'name' => fake()->name,
            'job' => fake()->jobTitle,
            'gender' => fake()->randomElement(array_values(ICustomer::GENDERS)),
            'tin' => fake()->randomNumber(9),
            'mobile_phone' => fake()->unique()->phoneNumber,
            'phone_number' => fake()->unique()->optional()->phoneNumber,
            'alternative_phone' => fake()->unique()->optional()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city,
            'state' => fake()->city,
            'postcode' => fake()->postcode,
            'country' => fake()->country,
            'birthday' => fake()->date,
            'notes' => fake()->optional()->text,
            'type' => fake()->randomElement(array_values(ICustomer::TYPES))
        ];
    }
}
