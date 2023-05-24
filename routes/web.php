<?php


use Illuminate\Support\Facades\Route;

Route::get('storage/*', function ($id) {
})->middleware('auth:sanctum');
