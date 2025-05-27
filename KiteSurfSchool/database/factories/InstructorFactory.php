<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instructor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = ['Kiteboarding', 'Windsurfing', 'Wakeboarding', 'SUP', 'Foiling'];
        
        return [
            'user_id' => User::factory(),
            'specialization' => $this->faker->randomElement($specializations),
            'bio' => $this->faker->paragraph(),
            'certifications' => $this->faker->randomElement(['IKO Level 1', 'IKO Level 2', 'IKO Level 3', 'VDWS', 'BPWS']),
            'years_of_experience' => $this->faker->numberBetween(1, 15),
        ];
    }
}
