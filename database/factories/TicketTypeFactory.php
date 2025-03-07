<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketTypes>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => random_int(1, 2) == 1 ? 'inteira' : 'meia',
            'event_id' => Event::all()->random()->id,
        ];
    }
//     - id: key(int)
// - name: string
// - event_id: foreign_key

}
