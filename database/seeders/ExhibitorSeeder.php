<?php

namespace Database\Seeders;

use App\Models\Exhibitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExhibitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exhibitor::factory()
        ->count(15)
        ->create();
    }
}
