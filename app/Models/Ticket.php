<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Definindo a relação com o modelo Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}