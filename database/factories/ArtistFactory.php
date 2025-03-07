<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'birth_date'=>fake()->date(),
            'phone'=>fake()->phoneNumber(),
            'fee'=>fake()->numberBetween(10000, 50000),

        ];
    }

//     Artists
// ------------------------
// - id: key(int)
// - name: string
// - age: int
// - phone: int
// - cache: decimal
}
