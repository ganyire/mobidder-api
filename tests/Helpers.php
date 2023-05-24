<?php

use App\Models\Category;
use App\Models\User;

/**
 * Create a new user
 */
if (!function_exists('createUser')) {
  function createUser(array $attributes = [], string $role = 'vendor-admin'): User
  {
    return User::factory()->addRole($role)->create($attributes);
  }
}


/**
 * Create a new product category
 */
if (!function_exists('createProductCategory')) {

  function createProductCategory(array $attributes): Category
  {
    return Category::factory()->create($attributes);
  }
}
