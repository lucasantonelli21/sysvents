<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $events->each(function ($event) {
            TicketType::factory()
                ->count(2)
                ->sequence(
                    ['name' => 'Inteira'],
                    ['name' => 'Meia'],
                )
                ->create([
                    'event_id' => $event->id,
                ]);
        });
    }
}
