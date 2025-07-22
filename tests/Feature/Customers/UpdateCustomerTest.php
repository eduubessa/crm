wwk<?php

use App\Models\Customer;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can update a customer successfully', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->put(route('customers.update', $customer), [
                'name' => 'Novo Nome',
                'email' => 'novo@email.com',
                'phone' => '912345678',
                'address' => 'Nova Morada 123',
            ])
        ->assertRedirect();

    expect($customer->fresh())->toMatchArray([
        'name' => 'Novo Nome',
        'email' => 'novo@email.com',
        'phone' => '912345678',
        'address' => 'Nova Morada 123',
    ]);
});

it('fails to update customer with missing required fields', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->put("customers/" . $customer->id)
        ->assertSessionHasErrors(['name', 'email']); // ajusta conforme os teus campos obrigatórios
});

it('fails to update customer with invalid email', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->put("customers/" . $customer->id, [
            'name' => 'Nome válido',
            'email' => 'email-invalido',
        ])
        ->assertSessionHasErrors(['email']);
});

it('does not allow guest to update a customer', function () {
    $customer = Customer::factory()->create();

    $this->put('/customers/'. $customer->id, [
            'name' => 'Teste',
            'email' => 'teste@email.com',
        ])
        ->assertRedirect(route('login')); // ou assertUnauthorized() se for API
});
