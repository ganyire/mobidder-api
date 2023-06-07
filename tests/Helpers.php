<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
 * Create multiple users
 */
if (!function_exists('createUsers')) {
  function createUsers(array $attributes = [], int $count = 2): Collection
  {
    return User::factory()->count($count)->create($attributes);
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

/**
 * Create multiple product categories
 */
if (!function_exists('createProductCategories')) {
  function createProductCategories(array $attributes = [], int $count = 2): Collection
  {
    return Category::factory()->count($count)->create($attributes);
  }
}
