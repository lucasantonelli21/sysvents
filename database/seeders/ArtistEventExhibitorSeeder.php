<?php

namespace Database\Seeders;

use App\Models\ArtistEventExhibitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistEventExhibitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            ArtistEventExhibitor::factory()
            ->count(50)
            ->create();
        }
    }
}
