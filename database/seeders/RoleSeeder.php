<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $roles = [
        [
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
        ],
        [
            'name' => 'vendor-admin',
            'display_name' => 'Vendor admin',
        ],
        [
            'name' => 'vendor',
            'display_name' => 'Vendor',
        ],
        [
            'name' => 'customer',
            'display_name' => 'Customer',
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sequence = new Sequence(...$this->roles);
        Role::factory(count($this->roles))->state($sequence)->create();
    }
}
