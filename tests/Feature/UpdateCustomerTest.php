<?php

use App\Helpers\Interfaces\ICustomer;
use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('updates the customer successfully with valid data', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    $updatedData = [
        'name' => fake()->name,
        'job' => fake()->jobTitle,
        'tin' => fake()->unique()->randomNumber(9),
        'mobile_phone' => fake()->unique()->phoneNumber,
        'phone_number' => fake()->unique()->optional()->phoneNumber,
        'alternative_phone' => fake()->unique()->optional()->phoneNumber,
        'email' => fake()->unique()->safeEmail(),
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'state' => fake()->city,
        'postcode' => fake()->postcode,
        'country' => fake()->country,
        'birthday' => fake()->date,
        'notes' => fake()->optional()->text,
        'type' => fake()->randomElement(array_values(ICustomer::TYPES))
    ];

    actingAs($user)
        ->put("/customers/{$customer->reference}", $updatedData)
        ->assertRedirect("/customers")
        ->assertSessionHas('success');

    $customer->refresh();

    expect($customer->reference)->toBe($customer["reference"])
        ->and($customer->name)->toBe($updatedData["name"])
        ->and($customer->email)->toBe($updatedData["email"]);
});

test('does not update the customer with invalid data', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    $updatedData = [
        'name' => fake()->name,
        'job' => fake()->jobTitle,
        'mobile_phone' => fake()->unique()->phoneNumber,
        'phone_number' => fake()->unique()->optional()->phoneNumber,
        'alternative_phone' => fake()->unique()->optional()->phoneNumber,
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'state' => fake()->city,
        'postcode' => fake()->postcode,
        'country' => fake()->country,
        'birthday' => fake()->date,
        'notes' => fake()->optional()->text,
        'type' => fake()->randomElement(array_values(ICustomer::TYPES))
    ];

    actingAs($user)
        ->from("/customers/")
        ->put("/customers/{$customer->reference}", $updatedData)
        ->assertRedirect("/customers")
        ->assertSessionHasErrors();

});

test('guest cannot create a customer', function () {

    $updatedData = [
        'name' => fake()->name,
        'job' => fake()->jobTitle,
        'mobile_phone' => fake()->unique()->phoneNumber,
        'phone_number' => fake()->unique()->optional()->phoneNumber,
        'alternative_phone' => fake()->unique()->optional()->phoneNumber,
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'state' => fake()->city,
        'postcode' => fake()->postcode,
        'country' => fake()->country,
        'birthday' => fake()->date,
        'notes' => fake()->optional()->text,
        'type' => fake()->randomElement(array_values(ICustomer::TYPES))
    ];

    $this->post('/customers', $updatedData)
        ->assertRedirect("/auth/sign-in");
});
