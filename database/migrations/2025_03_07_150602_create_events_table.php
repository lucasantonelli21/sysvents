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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('theme');
            $table->decimal('longitude');
            $table->decimal('latitude');
            $table->integer('batch');
            $table->timestamps();
        });
    }
    // - id: key(int)
    // - name: string
    // - start_date: date
    // - end_date: date
    // - theme: string
    // - long: string(50)
    // - lat: string (50)
    // - batch: int


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
