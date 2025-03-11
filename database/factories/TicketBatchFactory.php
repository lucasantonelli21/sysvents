<?php

namespace Database\Factories;

use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketBatches>
 */
class TicketBatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'batch' => random_int(1, 3),
            'price' => fake()->unique()->numberBetween(100, 500),
            'ticket_type_id' => TicketType::all()->random()->id,
        ];
    }
//     ticket_batches
// -----------------------
// - id: key(int)
// - name: string(25)
// - price ?
// ------------------------------------------
// - ticket_type_id: foreign_key
}
