<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 students with their own user accounts
        Student::factory(15)->create();

        // Create a specific test student with known credentials
        $user = User::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@test.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);

        Student::create([
            'user_id' => $user->id,
            'date_of_birth' => '1995-05-15',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '0123456789',
            'medical_notes' => 'No medical issues',
        ]);
    }
}
