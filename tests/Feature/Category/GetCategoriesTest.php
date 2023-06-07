<?php

use function Pest\Laravel\getJson;

test('users can get paginated categories if "per_page" query parameter is given', function () {
    createProductCategories(count: 20);

    $response = getJson("{$this->baseUrl}/categories?per_page=5&page=4");

    dd($response->json());

    $response->assertStatus(200);
});
