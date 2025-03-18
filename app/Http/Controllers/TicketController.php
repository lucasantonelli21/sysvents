<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

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

    // {
    //     $events = Event::soldTickets($request)->get();
    //     $eventsName = [];
    //     if($request->events) {
    //         foreach ($request->events as $event) {
    //             $eventProps = Event::select('id', 'name as text')->where('id', $event)->first();
    //             $eventsName[$eventProps->id] = $eventProps->text;
    //         }
    //     }
    //     return view('admin.dashboard', ["events" => $events, "eventsName" => $eventsName]);
    // }

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
}
