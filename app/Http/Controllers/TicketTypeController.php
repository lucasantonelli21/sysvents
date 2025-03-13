<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{

    public function index($id){
        $event = Event::find($id);
        $ticketTypes = $event->ticketTypes;
        $batches = [];

        foreach ($ticketTypes as $ticketType) {
            $batches[] = $ticketType->ticketBatches;
        }

        return view('ticket-types.index',[
            'event' => $event,
            'ticketTypes' => $ticketTypes,
            'batches' => $batches

        ]);
    }

}
