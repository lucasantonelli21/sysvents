<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */

class EventFactory extends Factory
{


    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $themes = [
            'technology',
            'cultural',
            'musical',
            'art',
            'sport',
            'gastronomy',
            'health',
        ];
        return [
            'name' => $this->faker->name,
            'description'=>fake()->realText(),
            'image_path' => fake()->randomElement(['/images/default-event-image.jpeg', '/images/evento-image.webp', '']),
            'start_date'=>fake()->dateTime(),
            'end_date'=>fake()->dateTime(),
            'theme' =>$themes[rand(0,6)],
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
