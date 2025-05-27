<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lespakketten>
 */
class LespakkettenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naam' => $this->faker->randomElement(['Privéles', 'Losse Duo Kiteles', 'Kitesurf Duo lespakket 3 lessen', 'Kitesurf Duo lespakket 5 lessen']),
            'beschrijving' => $this->faker->paragraph(),
            'prijs' => $this->faker->randomElement([175, 135, 375, 675]),
            'duur' => $this->faker->randomElement([2.5, 3.5, 10.5, 17.5]),
            'aantal_personen' => $this->faker->randomElement([1, 2]),
            'aantal_lessen' => $this->faker->randomElement([1, 3, 5]),
            'aantal_dagdelen' => $this->faker->randomElement([1, 3, 5]),
            'materiaal_inbegrepen' => true,
        ];
    }
}
