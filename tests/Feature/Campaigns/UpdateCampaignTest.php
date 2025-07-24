<?php

use App\Models\Campaign;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('authenticated user can update a campaign successfully', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $campaign = Campaign::factory()->create();

    $payload = [
        'name' => 'Updated Campaign Name',
        'preview_text' => 'Updated description for the campaign.',
    ];

    actingAs($user)
        ->put("/campaigns/{$campaign->id}", $payload)
        ->assertStatus(302)
        ->assertRedirect('/campaigns/');

    $campaign->refresh();

    $this->assertDatabaseHas('campaigns', [
        'id' => $campaign->id,
        'name' => 'Updated Campaign Name',
        'preview_text' => 'Updated description for the campaign.'
    ]);
});

test('authenticated but unverified user cannot update a campaign successfully', function () {
    $user = User::factory()->create();
    $campaign = Campaign::factory()->create();

    $payload = [
        'name' => 'Updated Campaign Name',
        'preview_text' => 'Updated description for the campaign.',
    ];

    actingAs($user)
        ->put("/campaigns/{$campaign->id}", $payload)
        ->assertStatus(302)
        ->assertRedirect('/account/verify/email');
});

test('guest cannot update a campaign successfully', function () {
    $campaign = Campaign::factory()->create();

    $payload = [
        'name' => 'Updated Campaign Name',
        'preview_text' => 'Updated description for the campaign.',
    ];

    $this->put("/campaigns/{$campaign->id}", $payload)
        ->assertStatus(302)
        ->assertRedirect('/auth/sign-in');
});

test('redirect to 404 error page if campaign does not exist', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $campaign_id = Str::uuid()->toString();

    $payload = [
        'name' => 'Updated Campaign Name',
        'preview_text' => 'Updated description for the campaign.',
    ];

    actingAs($user)
        ->put("/campaigns/{$campaign_id}", $payload)
        ->assertStatus(404)
        ->assertNotFound();
});
