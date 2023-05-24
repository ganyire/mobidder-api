<?php

use Laravel\Sanctum\Sanctum;
use Tests\RequestFactories\CreateProductRequestFactory;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

test('users can create product', function () {

    $user = createUser();
    $categoryName = 'Manufacturing';
    $category = createProductCategory([
        'name' => $categoryName
    ]);
    CreateProductRequestFactory::new([
        'category_id' => $category->id
    ])->fake();

    Sanctum::actingAs($user);
    $response = postJson("{$this->baseUrl}/products");

    $response->assertStatus(201);
    assertDatabaseCount('products', 1);
    assertDatabaseHas('products', [
        'id' => $response->json('payload.id'),
        'category_id' => $category->id
    ]);
});
