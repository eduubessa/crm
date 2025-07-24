<?php

use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('delete (soft delete) a customer by the authenticated user', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $customer = Customer::factory()->create();

    actingAs($user)
        ->delete("/customers/$customer->reference")
        ->assertStatus(302)
        ->assertRedirect("/customers")
        ->assertSessionHas('success', 'Customer deleted successfully!');

    $this->assertSoftDeleted('customers', [
        'reference' => $customer->reference,
    ]);
});

test('does not delete the customer without user valid', function () {
    $user = User::factory()->create(['email_verified_at' => null]);
    $customer = Customer::factory()->create();

    actingAs($user)
        ->delete("/customers/$customer->reference")
        ->assertStatus(302)
        ->assertRedirect("/account/verify/email");
});

test('does not delete the customer without authenticated user', function () {
    $customer = Customer::factory()->create();

    $this->delete("/customers/{$customer->reference}")
        ->assertRedirect('/auth/sign-in');
});

test('returns 404 if the customer to delete is not found', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $customer_reference = Str::uuid()->toString();

    actingAs($user)
        ->delete("/customers/{$customer_reference}")
        ->assertStatus(404)
        ->assertNotFound();
});
