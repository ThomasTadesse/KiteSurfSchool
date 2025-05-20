<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 instructors with their own user accounts
        Instructor::factory(5)->create();

        // Create a specific test instructor with known credentials
        $user = User::factory()->create([
            'name' => 'Test Instructor',
            'email' => 'instructor@test.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);

        Instructor::create([
            'user_id' => $user->id,
            'specialization' => 'Kiteboarding',
            'bio' => 'Professional instructor with 10+ years of experience',
            'certifications' => 'IKO Level 3, VDWS',
            'years_of_experience' => 10,
        ]);
    }
}
