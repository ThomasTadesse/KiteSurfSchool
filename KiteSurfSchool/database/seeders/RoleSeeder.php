<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default roles
        $roles = [
            [
                'name' => 'Klant',
                'slug' => 'klant',
                'description' => 'Regular customer role'
            ],
            [
                'name' => 'Instructeur',
                'slug' => 'instructeur',
                'description' => 'Kitesurf instructor role'
            ],
            [
                'name' => 'Eigenaar',
                'slug' => 'eigenaar',
                'description' => 'Owner/administrator role'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
