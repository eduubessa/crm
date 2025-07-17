<?php

use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('Delete (soft delete) a customer by the authenticated user', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)
        ->delete("/customers/$customer->reference")
        ->assertStatus(302)
        ->assertSessionHas('success');

    $this->assertSoftDeleted('customers', [
        'reference' => $customer->reference,
    ]);
});

test('Does not delete the customer without authenticated user', function () {

    $customer = Customer::factory()->create();

    $this->delete("/customers/{$customer->reference}")
        ->assertRedirect('/auth/sign-in');
});
