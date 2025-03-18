<?php

namespace Database\Factories;

use App\Enums\Themes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $themes = Themes::cases();
        $theme = $themes[0];

        return [
            'name'=>fake()->name(),
            'description'=>fake()->realText(),
            'start_date'=>fake()->dateTime(),
            'end_date'=>fake()->dateTime(),
            'theme' =>$theme,
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'batch' => random_int(1, 5)
        ];
    }
//     events
// ------------------------
// - id: key(int)
// - name: string
// - start_date: date
// - end_date: date
// - theme: string
// - long: string(50)
// - lat: string (50)
// - batch: int
}
