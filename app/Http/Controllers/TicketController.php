<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketBatch;
use App\Models\TicketType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request, $eventId)
    {
        $tickets = Ticket::TicketEvent($eventId,$request)->paginate($request->pagination ?? 10)->withQueryString();
        $event = Event::find($eventId);
        return view('tickets.index', [
            'tickets' => $tickets,
            'event' => $event
        ]);
    }
    public function form()
    {

    }

    public function delete($eventId, $id)
    {
        try {
            $ticket = Ticket::find($id);
            if ($ticket == null) {
                return redirect()->route('panel.events.tickets.index',[$eventId])->withErrors("Erro ao deletar o Ticket");
            } else {
                $ticket->delete();
                return redirect()->route('panel.events.tickets.index',[$eventId])->withSuccess("Ticket deletado com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }
        public function createOrEdit( $eventId, $ticket = null,$userId = null){
            $event = Event::find($eventId);
            $ticket = Ticket::findOrNew($ticket);
            $user = User::find($userId);
            $ticket_types = TicketType::select('ticket_types.*')->where('event_id', 'ilike', '%'.$event->id.'%')->get();
            return view('tickets.form', [
                'ticket' => $ticket,
                'ticket_types' => $ticket_types,
                'event' => $event,
                'user' => $user
                ]);
        }

    public function save($eventId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'ticket_type' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())
                ->withInput();
        }
        $user = User::where('email', '=', $request->email)->first();
        $ticket_batch = TicketBatch::select('ticket_batches.*')
        ->where('ticket_type_id', '=', $request->ticket_type)
        ->where('name', '=', 'Cortesia')->first();
        $ticket = Ticket::findOrNew($request->ticketId);

        $transaction = new Transaction();
        $transaction->user_id= $user->id;
        $transaction->amount= 0;
        $transaction->save();

        $ticket->owner_name = $user->name;
        $ticket->owner_cpf = $user->cpf;
        $ticket->user_id= $user->id;
        $ticket->transaction_id= $transaction->id;
        $ticket->ticket_batch_id = $ticket_batch->id;


        $ticket->save();

        return redirect()->route('panel.events.tickets.index', [$eventId])->withSuccess($ticket->id ? "Ingresso criado com sucesso" : "Erro ao cadastrar ingresso");;
    }

}

