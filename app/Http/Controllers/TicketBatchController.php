<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketBatch;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketBatchController extends Controller
{
    public function index($eventId, $ticketTypeId){
        $event = Event::find($eventId);
        foreach($event->ticketTypes as $ticketType){
            if($ticketType->id == $ticketTypeId){
                $ticketType = $ticketType;
            }
        }
        $ticketBatches = $ticketType->ticketBatches;

        return view('ticket-batches.index',["event" => $event, "ticketType" => $ticketType, "ticketBatches" => $ticketBatches]);
    }

    public function createOrEdit($eventId, $ticketTypeId, $id = null){
        $event = Event::find($eventId);
        $ticketType = TicketType::find($ticketTypeId);
        $ticketBatch =  TicketBatch::findOrNew($id);

        return view('ticket-batches.form', [
            'event' => $event,
            'ticketType' => $ticketType,
            'ticketBatch' => $ticketBatch
        ]);
    }

    public function save(Request $request){

    }



}
