<?php

use App\Models\Tag;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('delete (soft delete) a tag by the authenticated user', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $tag = Tag::factory()->create();

    actingAs($user)
        ->delete('/tags/' . $tag->slug)
        ->assertStatus(302)
        ->assertRedirect('/tags')
        ->assertSessionHas('success', 'Tag deleted successfully');

    $this->assertSoftDeleted('tags', ['id' => $tag->id]);
});

test('cannot delete a tag by the user not verified', function () {
    $user = User::factory()->create(['email_verified_at' => null]);
    $tag = Tag::factory()->create();

    actingAs($user)
        ->delete('/tags/' . $tag->slug)
        ->assertStatus(302)
        ->assertRedirect('/account/verify/email');
});

test('cannot delete a tag by the user guest', function () {
    $tag = Tag::factory()->create();

    $this->delete('/tags/' . $tag->slug)
        ->assertStatus(302)
        ->assertRedirect('/auth/sign-in');
});

test('returns 404 if the tag to delete is not found', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    actingAs($user)
        ->delete('/tags/non-existing-tag')
        ->assertStatus(404)
        ->assertNotFound();
});
