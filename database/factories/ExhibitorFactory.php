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
        $categories = [
            'cultural',
            'musical',
            'children',
            'fashion',
            'technology',
            'gastronomy',
        ];
        return [
            'name' => fake()->streetName(),
            'category'=>$categories[rand(0,5)],
            'description'=>fake()->realText()
        ];
    }


// - id: key(int)
// - name: string
// -category: string
// -description: string
}
