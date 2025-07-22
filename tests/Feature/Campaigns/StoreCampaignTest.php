<?php

use App\Models\Campaign;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('creates a campaign successfully', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $payload = [
        'name' => fake()->realText(10),
        'subject' => fake()->realText(10),
        'reply_to' => fake()->safeEmail(),
        'preview_text' => fake()->realText(30),
        'html_content' => fake()->randomHtml(15),
        'type' =>  fake()->randomElement(['html', 'text', 'plain']),
        'status' => fake()->randomElement(['active', 'inactive']),
    ];

    actingAs($user)
        ->post('/campaigns', $payload)
        ->assertStatus(302)
        ->assertRedirect('/campaigns');

    $this->assertDatabaseHas('campaigns', [
        'name' => $payload['name'],
        'reply_to' => $payload['reply_to'],
        'subject' => $payload['subject'],
    ]);
});

test('fails when required field are missing', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $payload = [
        'name' => fake()->realText(10),
        'reply_to' => fake()->safeEmail(),
        'preview_text' => fake()->realText(30),
        'html_content' => fake()->randomHtml(15),
        'status' => fake()->randomElement(['active', 'inactive']),
    ];

    actingAs($user)
        ->post('/campaigns', $payload)
        ->assertStatus(302)
        ->assertSessionHasErrors(['subject']);
});


