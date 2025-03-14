<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasFactory;

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function scopeSearch($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        if ($request->theme) {
            $query->where('theme', 'ilike', $request->theme);
        }

        // $query->selectRaw('*, description::varchar(10)');

        return $query;
    }

    protected function casts(): array
    {
        return [
            "start_date" => "datetime"
        ];
    }


    public function scopeSoldTickets($query, $request)
    {

        $query->from('events as e')
            ->join('ticket_types as tp', 'tp.event_id', '=', 'e.id')
            ->join('ticket_batches as tb', 'tb.ticket_type_id', '=', 'tp.id')
            ->join('tickets as t', 't.ticket_batch_id', '=', 'tb.id')
            ->selectRaw(
                'e.id AS event_id,
                e.name AS event_name,
                count(t.id) AS total_tickets,
                sum(tb.price) AS total_revenue'
            )
            ->groupBy('e.id', 'e.name');

        if ($request->events) {
            $query->whereIn('e.id', $request->events);
        }

        return $query;

    }
}
