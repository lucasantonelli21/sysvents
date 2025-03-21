<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketBatch;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketTypeController extends Controller
{

    public function index($eventId)
    {
        $event = Event::find($eventId);
        $ticketTypes = $event->ticketTypes;

        foreach ($ticketTypes as $ticketType) {
            $batches[] = $ticketType->ticketBatches;
        }

        return view('ticket-types.index', [
            'event' => $event,
            'ticketTypes' => $ticketTypes

        ]);
    }

    public function createOrEdit($eventId, $id = null)
    {
        $event = Event::find($eventId);
        $ticketType =  TicketType::findOrNew($id);

        return view('ticket-types.form', [
            'event' => $event,
            'ticketType' => $ticketType
        ]);
    }

    public function save(Request $request, $eventId, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $ticketType = TicketType::findOrNew($request->id);
        $ticketType->name = $request->name;
        $ticketType->event_id = $eventId;
        $ticketType->save();
        if (!$request->id) {
            $ticketBatch = new TicketBatch();
            $ticketBatch->name = 'Cortesia';
            $ticketBatch->batch = 0;
            $ticketBatch->price = 0;
            $ticketBatch->ticket_type_id = $ticketType->id;
            $ticketBatch->save();
            return redirect()->route('panel.events.tickets.types.index',$eventId)->withSuccess('Tipo de Ingresso ' . $ticketType->name . ' Criado com Successo!');
        }
        return redirect()->route('panel.events.tickets.types.index',$eventId)->withSuccess('Tipo de Ingresso ' . $ticketType->name . ' Atualizado com Successo!');
    }

    public function delete($eventId, $id)
    {
        $ticketType = TicketType::find($id);
        if(!$ticketType){
            return redirect()->route('panel.events.tickets.types.index',$eventId)->withErrors('Tipo de Ingresso não encontrado!');
        }
        $ticketType->delete();
        return redirect()->route('panel.events.tickets.types.index',$eventId)->withSuccess('Tipo de Ingresso ' . $ticketType->name . ' Deletado com Successo!');
    }

}
