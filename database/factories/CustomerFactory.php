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
        $faker = $this->faker;

        // reset único se estiveres a gerar muitos seguidos (opcional)
        $faker->unique(false);

        return [
            'reference' => $faker->uuid(),
            'name' => $faker->name(),
            'job' => $faker->jobTitle(),
            'gender' => $faker->randomElement(array_values(ICustomer::GENDERS)),
            'tin' => $faker->numerify('#########'), // exatamente 9 dígitos
            'mobile_phone' => $faker->unique()->phoneNumber(),
            'phone_number' => $faker->optional()->phoneNumber(),
            'alternative_phone' => $faker->optional()->phoneNumber(),
            'email' => $faker->unique()->safeEmail(),
            'address' => $faker->streetAddress(),
            'city' => $faker->city(),
            'state' => $faker->city(),
            'postcode' => $faker->postcode(),
            'country' => $faker->country(),
            'birthday' => $faker->date(),
            'notes' => $faker->optional()->text(),
            'type' => $faker->randomElement(array_values(ICustomer::TYPES)),
        ];
    }
}
