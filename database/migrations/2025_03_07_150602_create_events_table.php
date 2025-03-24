<?php

use App\Enums\Themes;
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
            $table->string('name', 50);
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('theme', Themes::toArray());
            $table->decimal('longitude',11,8);
            $table->decimal('latitude',10,8);
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
