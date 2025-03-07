<?php

namespace Database\Seeders;

use App\Models\TicketBatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketBatch::factory()
        ->count(50)
        ->create();
    }

}
