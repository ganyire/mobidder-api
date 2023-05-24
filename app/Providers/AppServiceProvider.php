<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Scribe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            $rule = Password::min(6)->mixedCase()->numbers();
            return $rule;
        });

        JsonResource::withoutWrapping();
    }
}
