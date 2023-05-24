<?php

use Laravel\Sanctum\Sanctum;
use Tests\RequestFactories\CreateCategoryRequestFactory;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\postJson;

test('admin can create product category', function () {
    $categoryName = 'Manufacturing and Production';
    $user = createUser(role: 'super-admin');
    CreateCategoryRequestFactory::new([
        'name' => $categoryName,
    ])->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/categories");

    $response->assertStatus(201);
    $response->assertJsonPath(
        'payload.slug',
        strtolower(str_replace(' ', '-', $categoryName))
    );
    assertDatabaseCount('categories', 1);
});
