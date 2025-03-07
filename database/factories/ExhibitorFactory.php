<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\exhibitor>
 */
class exhibitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->streetName(),
            'category'=>fake()->monthName(),
            'description'=>fake()->realText()
        ];
    }


// - id: key(int)
// - name: string
// -category: string
// -description: string
}
