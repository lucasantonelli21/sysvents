<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\Transaction;
use App\Models\User;
use Database\Seeders\TicketSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * Define o estado inicial da transação.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'amount' => 1,  // Valor inicial
        ];
    }
}
