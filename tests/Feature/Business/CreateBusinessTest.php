<?php

use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\RequestFactories\CreateBusinessRequestFactory;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

/**
 * test users (vendor-admin) can create business profile
 * assert that the business profile is created
 * assert that the business profile is associated with the user
 */
test('vendors can create business profile', function () {
    $user = createUser(role: 'vendor-admin');
    $logoName = 'logo';
    $extension = 'png';
    CreateBusinessRequestFactory::new()
        ->withAddress()
        ->withLogo(extension: $extension, logoName: $logoName)
        ->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/businesses");

    // dd($response->json());

    $response->assertStatus(200);
    $response->assertJsonPath('payload.address', fn ($address) => !is_null($address));
    Storage::disk('test')->assertExists($response->json('payload.logo.id') . "/{$logoName}.{$extension}");
    assertDatabaseCount('businesses', 1);
    assertDatabaseHas('businesses', [
        'user_id' => $user->id,
    ]);
});

/**
 * test users (vendor-admin) cannot create business profile with invalid data
 * by not providing country or city in the address when they have provided street address
 */
test('vendors cannot create business profile with invalid data', function () {
    $propertiesToReturnErrors = ['country', 'city'];
    $user = createUser(role: 'vendor-admin');
    CreateBusinessRequestFactory::new()->withAddress()
        ->without($propertiesToReturnErrors)
        ->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/businesses");

    $response->assertStatus(422);
    $response->assertJsonValidationErrors($propertiesToReturnErrors);
    assertDatabaseEmpty('businesses');
});
