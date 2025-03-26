<?php

namespace Database\Factories;

use App\Enums\Themes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\Address;
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
        $theme = $themes[random_int(0, count($themes)-1)];

        return [
            'name' => $this->faker->name,
            'is_free' => false,
            'description'=>fake()->realText(),
            'image_path' => fake()->randomElement(['/events/default-event-image.jpeg', '/events/evento-image.webp', '']),
            'start_date'=>fake()->dateTime(),
            'end_date'=>fake()->dateTime(),
            'theme' =>$theme,
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'cep' => $this->faker->numerify('#####-###'),
            'address' => fake()->address(),
            'address_number' => 0,
            'neighborhood' => fake()->citySuffix(),
            'city' => fake()->city(),
            'state' => $this->faker->stateAbbr(),
            'complement' => fake()->secondaryAddress(),
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
