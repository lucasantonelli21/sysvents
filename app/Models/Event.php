<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Themes;

class Event extends Model
{

    use HasFactory;

    public function ticketTypes(){
        return $this->hasMany(TicketType::class);
    }

    public function scopeSearch($query, $request){
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        if($request->themes) {
            // $query->Where('theme', 'like', $request->theme->first());
            //JOIN?
            for($i = 0; $i < count($request->themes); $i++) {
                if($i == 0) {
                    $query->where('theme', 'like', $request->themes[$i]);
                }else {
                    $query->orWhere('theme', 'like', $request->themes[$i]);
                }
            }
        }

        return $query;
    }

    protected function casts():array {
        return [
            "start_date" => "datetime",
            "theme" => Themes::class
        ];
    }


    public function scopeSoldTickets($query){
        return $query->from('events as event') // Defina o alias "event" aqui
        ->join('ticket_types as ticket_type', 'ticket_type.event_id', '=', 'event.id')
        ->join('ticket_batches as ticket_batch', 'ticket_batch.ticket_type_id', '=', 'ticket_type.id')
        ->join('tickets as ticket', 'ticket.ticket_batch_id', '=', 'ticket_batch.id')
        ->selectRaw(
            'event.id AS event_id,
             event.name AS event_name,
             count(ticket.id) AS total_tickets,
             sum(ticket_batch.price) AS total_revenue'
        )
        ->groupBy('event.id', 'event.name');


    }
}
