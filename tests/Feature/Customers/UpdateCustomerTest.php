wwk<?php

use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can update a customer successfully', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $customer = Customer::factory()->create();

    $payload = [
        'name' => 'Novo Nome',
        'tin' => '123456789',
        'email' => 'novo@email.com',
        'address' => 'Nova Morada 123',
        'city' => 'Nova Cidade',
        'country' => 'Portugal',
        'postcode' => '1234-567',
        'birthday' => '1990-01-01'
    ];

    actingAs($user)->put("/customers/{$customer->reference}", $payload)
        ->assertStatus(302)
        ->assertRedirect('/customers');

    $customer->refresh();

    expect($customer->name)->toBe('Novo Nome');

});

it('fails to update customer with missing required fields', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $customer = Customer::factory()->create();

    $payload = [
        'tin' => '123456789',
        'address' => 'Nova Morada 123',
        'city' => 'Nova Cidade',
        'country' => 'Portugal',
        'postcode' => '1234-567',
        'birthday' => '1990-01-01'
    ];

    actingAs($user)->put("customers/" . $customer->id, $payload)
        ->assertStatus(302)
        ->assertSessionHasErrors('name', 'email');
});

test('fails to update the customer with user not verified', function () {
    $user = User::factory()->create(['email_verified_at' => null]);
    $customer = Customer::factory()->create();

    $payload = [
        'name' => 'Novo Nome',
        'tin' => '123456789',
        'email' => 'novo@email.com',
        'address' => 'Nova Morada 123',
        'city' => 'Nova Cidade',
        'country' => 'Portugal',
        'postcode' => '1234-567',
        'birthday' => '1990-01-01'
    ];

    actingAs($user)->put("customers/" . $customer->id, $payload)
        ->assertStatus(302)
        ->assertRedirect('/account/verify/email');

});

it('fails to update customer with invalid email', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $customer = Customer::factory()->create();

    $payload = [
        'name' => 'Novo Nome',
        'tin' => '123456789',
        'email' => 'novo.email.com',
        'address' => 'Nova Morada 123',
        'city' => 'Nova Cidade',
        'country' => 'Portugal',
        'postcode' => '1234-567',
        'birthday' => '1990-01-01'
    ];

    actingAs($user)->put("customers/" . $customer->id, $payload)
        ->assertSessionHasErrors(['email']);
});

it('does not allow guest to update a customer', function () {
    $customer = Customer::factory()->create();

    $payload = [
        'name' => 'Novo Nome',
        'tin' => '123456789',
        'email' => 'novo@email.com',
        'address' => 'Nova Morada 123',
        'city' => 'Nova Cidade',
        'country' => 'Portugal',
        'postcode' => '1234-567',
        'birthday' => '1990-01-01'
    ];

    $this->put('/customers/'. $customer->id, $payload)
        ->assertStatus(302)
        ->assertRedirect('/auth/sign-in');
});
