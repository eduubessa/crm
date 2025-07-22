<?php

use App\Models\Campaign;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('a campaign can be soft deleted', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $campaign = Campaign::factory()->create();

    actingAs($user)
        ->delete("/campaigns/" . $campaign->id);

    $this->assertSoftDeleted('campaigns', [
        'id' => $campaign->id,
    ]);
});

test('cannot delete non-existent campaign', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $uuid = Str::uuid()->toString();

    actingAs($user)
        ->delete("/campaigns/" . $uuid)
        ->assertNotFound();
});

test('cannot delete campaign if not authenticated', function () {
    $campaign = Campaign::factory()->create();

    $this->delete("/campaigns/" . $campaign->id)
        ->assertRedirect('/auth/sign-in');
});

test('cannot delete campaign if not verified', function () {
    $user = User::factory()->create(['email_verified_at' => null]);
    $campaign = Campaign::factory()->create();

    actingAs($user)
        ->delete("/campaigns/{$campaign->id}")
        ->assertStatus(302)
        ->assertRedirect('/account/verify/email');
});

// TODO: Cannot delete campaign without permission
