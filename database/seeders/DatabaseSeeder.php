<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('testing')) {
            $this->call([
                RoleSeeder::class,
            ]);
        } else {
            $this->call([
                LaratrustSeeder::class,
            ]);
        }
    }
}
