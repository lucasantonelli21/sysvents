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

    // {
    //     $query->from('tickets as t')
    //         ->join('ticket_batches as tb', 't.ticket_batch_id', '=', 'tb.id')
    //         ->join('ticket_types as tp', 'tb.ticket_type_id', '=', 'tp.id')
    //         ->join('events as e', 'tp.event_id', '=', 'e.id')
    //         ->select(
    //             't.id AS ticket_id',
    //             't.name AS ticket_name',
    //             'e.name AS event_name' // Caso queira também o nome do evento
    //         )
    //         ->groupBy('t.id', 'e.name'); // Aqui 'e.name' também precisa estar no GROUP BY para ser válido no PostgreSQL

    //     if($eventId) {
    //         $query->whereIn('t.id', $eventId);
    //     }
    //     return $query;
    // }

    // public function scopeSoldTickets($query, $request)
    // {

    //     $query->from('events as e')
    //         ->join('ticket_types as tp', 'tp.event_id', '=', 'e.id')
    //         ->join('ticket_batches as tb', 'tb.ticket_type_id', '=', 'tp.id')
    //         ->join('tickets as t', 't.ticket_batch_id', '=', 'tb.id')
    //         ->selectRaw(
    //             'e.id AS event_id,
    //             e.name AS event_name,
    //             count(t.id) AS total_tickets,
    //             sum(tb.price) AS total_revenue'
    //         )
    //         ->groupBy('e.id', 'e.name');

    //     if ($request->events) {
    //         $query->whereIn('e.id', $request->events);
    //     }

    //     return $query;

    // }


// $query->from('tickets as t')
// ->join('ticket_batches as tb', 't.ticket_batch_id', 'tb.id')
// ->join('ticket_types as tp', 'tb.ticket_type_id', 'tp.id')
// ->join('events as e', 'tp.event_id', 'e.id')
// ->selectRaw(
//     't.id AS ticket_id',
//     't.name AS ticket_name',
// )
// ->groupBy('t.id', 'e.name');

// if($eventId) {
//     $query->whereIn('t.id', $eventId);
// }
// return $query;
// }