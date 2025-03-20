<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketBatch;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketBatchController extends Controller
{
    public function index($eventId, $ticketTypeId){
        $event = Event::find($eventId);
        foreach($event->ticketTypes as $eventsTicketsType){
            if($eventsTicketsType->id == $ticketTypeId){
                $ticketType = $eventsTicketsType;
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

    public function save(Request $request, $eventId,$ticketTypeId, $id = null){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'batch' => 'required',
        ], [
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $ticketBatch = TicketBatch::findOrNew($id);
        $ticketBatch->batch = $request->batch;
        $ticketBatch->name = $request->name;
        $ticketBatch->price = $request->price;
        $ticketBatch->ticket_type_id = $ticketTypeId;
        $ticketBatch->save();
        if (!$request->id) {
            return redirect()->route('panel.events.tickets.types.batches.index',[$eventId,$ticketTypeId])->withSuccess('Lote' . $ticketBatch->name . ' Criado com Successo!');
        }
        return redirect()->route('panel.events.tickets.types.batches.index',[$eventId,$ticketTypeId])->withSuccess('Lote ' . $ticketBatch->name . ' Atualizado com Successo!');
    }

    public function delete($eventId, $ticketTypeId, $id){
        $ticketBatch = TicketBatch::find($id);
        $ticketBatch->delete();
        return redirect()->route('panel.events.tickets.types.batches.index',[$eventId,$ticketTypeId])->withSuccess('Lote ' . $ticketBatch->name . ' Deletado com Successo!');
    }



}
