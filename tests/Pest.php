<?php

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Plannr\Laravel\FastRefreshDatabase\Traits\FastRefreshDatabase;
use Tests\Traits\FeatureTestTrait;
use Tests\Traits\UnitTestTrait;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class)
  ->beforeEach(fn () => $this->seed())
  ->afterEach(fn () =>  Storage::disk('test')->deleteDirectory('/'))->in('Feature');

uses(FeatureTestTrait::class)->in('Feature');
uses(FastRefreshDatabase::class)->in('Feature');

uses(UnitTestTrait::class)->in('Unit');
