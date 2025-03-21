<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    public function ticketBatches(){
        return $this->hasMany(TicketBatch::class);
    }

    public function events(): BelongsTo {
        return $this->belongsTo(Event::class);
    }

}
