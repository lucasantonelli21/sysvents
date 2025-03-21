<?php

namespace Database\Factories;

use App\Models\TicketBatch;
use App\Models\TicketBatches;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define o estado inicial do ticket.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_name' => fake()->name(),
            'owner_cpf' => fake()->unique()->numberBetween(10000000000, 99999999999),
            'user_id' => User::all()->random()->id,
            'transaction_id' => Transaction::all()->random()->id,
            'ticket_batch_id' => TicketBatch::all()->random()->id,
        ];
    }
}
