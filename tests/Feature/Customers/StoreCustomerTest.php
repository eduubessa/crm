<?php

use App\Helpers\Interfaces\ICustomer;
use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('passes validation with valid customer data', function () {

    $user = User::factory()->create();

    $data = [
        'name' => fake()->name,
        'job' => fake()->jobTitle,
        'gender' => fake()->randomElement(array_values(ICustomer::GENDERS)),
        'tin' => fake()->unique()->randomNumber(9),
        'mobile_phone' => fake()->unique()->phoneNumber,
        'phone_number' => fake()->unique()->optional()->phoneNumber,
        'alternate_phone' => fake()->unique()->optional()->phoneNumber,
        'email' => fake()->unique()->safeEmail,
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'state' => fake()->city,
        'postcode' => fake()->postcode,
        'country' => fake()->country,
        'birthday' => fake()->date,
        'notes' => fake()->optional()->text,
        'type' => fake()->randomElement(ICustomer::TYPES)
    ];

    actingAs($user)
        ->post("/customers/", $data)
        ->assertStatus(302);

    $this->assertDatabaseHas('customers', [
        'name' => $data['name'],
        'tin' => $data['tin'],
    ]);
});

test("fails validation with valid missing fields", function () {
    $user = User::factory()->create();

    $data = [
        'email' => fake()->unique()->safeEmail,
        'mobile_phone' => fake()->unique()->phoneNumber,
    ];

    $fieldsRequiredAndMissing = [
        'name',
        'job',
        'tin',
        'address',
        'city',
        'state',
        'postcode',
        'country',
        'birthday',
        'gender',
        'type',
    ];

    actingAs($user)
        ->from('/customers')
        ->post("/customers", $data)
        ->assertRedirect('/customers')
        ->assertSessionHasErrors($fieldsRequiredAndMissing);
});

test("guest cannot create a customer", function () {

    $data = [
        'name' => fake()->name,
        'job' => fake()->jobTitle,
        'gender' => fake()->randomElement(array_values(ICustomer::GENDERS)),
        'tin' => fake()->unique()->randomNumber(9),
        'mobile_phone' => fake()->unique()->phoneNumber,
        'phone_number' => fake()->unique()->optional()->phoneNumber,
        'alternate_phone' => fake()->unique()->optional()->phoneNumber,
        'email' => fake()->unique()->safeEmail,
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'state' => fake()->city,
        'postcode' => fake()->postcode,
        'country' => fake()->country,
        'birthday' => fake()->date,
        'notes' => fake()->optional()->text,
        'type' => fake()->randomElement(ICustomer::TYPES)
    ];

    post('customers', $data)
        ->assertRedirect('/auth/sign-in');
});
