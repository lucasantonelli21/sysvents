<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artist_event_exhibitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id');
            $table->foreignId('event_id');
            $table->foreignId('exhibitors_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_event_exhibitors');
    }
};
