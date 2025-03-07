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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('owner_cpf');
            $table->foreignId('user_id');
            $table->foreignId('transaction_id');
            $table->foreignId('ticket_batch_id');
            $table->timestamps();
        });
    }

//     - owner_name: string
// - owner_cpf: string
// ------------------------------------------
// - user_id: foreign_key
// - transaction_id: foreign_key
// - ticket_branch_id: foreign_key

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
