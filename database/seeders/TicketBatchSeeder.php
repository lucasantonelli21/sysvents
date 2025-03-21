<?php

namespace Database\Seeders;

use App\Models\TicketBatch;
use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTypes = TicketType::all();

        $batches = [
            ['name' => 'Cortesia', 'batch' => 0, 'price' => 0],
            ['name' => 'Primeiro Lote', 'batch' => 1, 'price' => 100],
            ['name' => 'Segundo Lote', 'batch' => 2, 'price' => 150],
        ];


        $ticketTypes->each(function ($ticketType) use ($batches) {
            foreach ($batches as $batch) {
                TicketBatch::factory()->create([
                    'name' => $batch['name'],
                    'batch' => $batch['batch'],
                    'price' => $batch['price'],
                    'ticket_type_id' => $ticketType->id,
                ]);
            }
        });
    }
}
