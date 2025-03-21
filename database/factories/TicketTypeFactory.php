<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;


class TicketTypeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => random_int(1, 2) == 1 ? 'inteira' : 'meia',
            'event_id' => 0,
        ];
    }
}
    // class TicketTypeFactory extends Factory
    // {

    //     public function definition(): array
    //     {
    //         return [
    //             [
    //                 'name' => 'inteira',
    //                 'event_id' => 0,
    //             ],
    //             [
    //                 'name' => 'meia',
    //                 'event_id' => 0,
    //             ],
    //         ];
    //     }
    // }