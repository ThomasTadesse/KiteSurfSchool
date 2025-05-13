<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eigenaarRole = Role::where('slug', 'eigenaar')->first();
        
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin1234'),
            'activation_token' => null,
            'active' => true,
        ]);
        
        // Attach eigenaar role to the admin user
        if ($eigenaarRole) {
            $user->roles()->attach($eigenaarRole);
        }
    }
}
