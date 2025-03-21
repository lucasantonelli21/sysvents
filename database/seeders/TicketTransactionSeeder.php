<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Ticket;

class TicketTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = Transaction::factory()->count(10)->create();

        $transactions->each(function ($transaction) {
            Ticket::factory()->count(5)->create([
                'transaction_id' => $transaction->id,
            ]);

            $tickets = Transaction::ticketAmount($transaction->id)->get();

            $amount = 0;
            foreach ($tickets as $ticket) {
                $amount += $ticket->ticket_batches_price;
            }

            $transaction->update(['amount' => $amount]);
        });
    }
}
