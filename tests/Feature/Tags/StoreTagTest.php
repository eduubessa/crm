<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('creates a tag successfully', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $name = fake()->unique()->word;

    $payload = [
        'name' => $name,
        'slug' => Str::slug($name),
    ];

    actingAs($user)
        ->post('/tags', $payload)
        ->assertStatus(302)
        ->assertRedirect('/tags')
        ->assertSessionHas('success', 'Tag created successfully.');

    $this->assertDatabaseHas('tags', [
        'name' => $payload['name'],
        'slug' => $payload['slug']
    ]);
});

test('fails when required fields are missing', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $payload = [];

    actingAs($user)
        ->post('/tags', $payload)
        ->assertStatus(302)
        ->assertRedirect('/')
        ->assertSessionHasErrors(['name' => 'The name field is required.']);

    $this->assertDatabaseMissing('tags', ['name']);

});


