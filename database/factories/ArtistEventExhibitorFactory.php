<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Exhibitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\artist_event_exhibitor>
 */
class ArtistEventExhibitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_id'=> Artist::all()->random()->id,
            'event_id'=> Event::all()->random()->id,
            'exhibitor_id'=> Exhibitor::all()->random()->id,
        ];
    }
}
