<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Definindo a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definindo a relação com o modelo Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
