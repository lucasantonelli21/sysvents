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

    public function scopeTicketEvent($query, $eventId, $request)
    {
        $query->from('tickets as t')
            ->join('ticket_batches as tb', 't.ticket_batch_id', '=', 'tb.id')
            ->join('ticket_types as tp', 'tb.ticket_type_id', '=', 'tp.id')
            ->join('events as e', 'tp.event_id', '=', 'e.id')
            ->leftJoin('users as u', 't.user_id', '=', 'u.id')
            ->select(
                't.id AS ticket_id',
                'e.name AS event_name',
                'tb.batch AS ticket_batches_batch',
                'tp.name AS ticket_types_name',
                'tb.price AS ticket_batches_price',
                'u.name AS users_name'
            )

            ->where('e.id', $eventId)
            ->groupBy('t.id', 'e.name', 'tb.batch', 'tp.name', 'tb.price', 'u.name');


        if ($request->name) {
            $query->where('u.name', 'like', '%' . $request->name . '%');
        }

        if ($request->batch) {
            $query->where('tb.batch', 'like', '%' . $request->batch . '%');
        }

        if ($request->ticket_type) {
            $query->where('tp.name', 'like', '%' . $request->ticket_type . '%');
        }

        if ($request->price) {
            $query->where('tb.price', $request->price);
        }



        return $query;
    }
}