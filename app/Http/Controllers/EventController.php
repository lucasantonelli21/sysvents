<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Enums\Themes;
use App\Models\Ticket;
use App\Models\TicketBatch;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EventController extends Controller

{
    public function index(Request $request)
    {
        $events = Event::search($request)->orderBy('id', 'desc')->paginate($request->pagination ?? 10)->withQueryString();

        return view('events.index', [

            'events' => $events
        ]);
    }

    public function showEvent($id)
    {
        $event = Event::findOrFail($id);

        if (Auth::check()) {
            //Verifica se o usuário já está inscrito no evento.
            $ticket_types_from_event = DB::table('ticket_types')->where('event_id', $event->id)->get('id')->pluck('id')->toArray(); // pode ser nulo
            $ticket_batches = $ticket_types_from_event == NULL ? [] : DB::table('ticket_batches')->whereIn('ticket_type_id', $ticket_types_from_event)->get('id')->pluck('id')->toArray(); //poder ser vazio
            $is_subscribed = DB::table('tickets')->where('user_id', Auth::user()->id)->whereIn('ticket_batch_id', $ticket_batches)->get()->toArray() == [] ? false : true;
        } else {
            $is_subscribed = false;
        }

        $data = [
            'event' => $event,
            'is_subscribed' => $is_subscribed
        ];

        return view('events.event', $data);
    }

    public function showLibrary(Request $request)
    {

        $events = Event::search($request)->orderBy('id', 'desc')->get();

        $themes = Themes::toArray();

        $data = [
            "events" => $events,
            "themes" => $themes
        ];

        return view('events.library', $data);
    }

    public function delete($id)
    {
        //como o botao delete sabe o ID do filme?
        try {
            $event = Event::find($id);
            if ($event == null) {
                return redirect()->route('panel.events.index')->withErrors("Erro ao deletar o Evento");
            } else {
                Storage::disk('public')->delete($event->image_path);
                $event->delete();
                return redirect()->route('panel.events.index')->withSuccess("Evento deletado com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }

    public function save(Request $request)
    {
        if (!$request->id) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'theme' => 'required|',
                // 'longitude' =>'required',
                // 'latitude' =>'required',
                'batch' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'theme' => 'required|',
                'longitude' => 'required',
                'latitude' => 'required',
                'cep' => 'required',
                'address' => 'required',
                'neighborhood' => 'required',
                'complement' => 'required',
                'city' => 'required',
                'state' => 'required',
                'batch' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())
                ->withInput();
        }

        $event = Event::findOrNew($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        if ($request->image_path) {
            if ($request->id && $event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $filename =  'events/' . time() . '.' . $request->image_path->extension();
            // $request->image_path->move(public_path('images/'), $filename);
            Storage::disk('public')->put($filename, file_get_contents($request->image_path));
            $event->image_path = $filename;
        }
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->theme = $request->theme;
        $event->longitude = $request->longitude;
        $event->latitude = $request->latitude;
        $event->cep = $request->cep;
        $event->address = $request->address;
        $event->address_number = $request->address_number ? $request->address_number : 0;
        $event->neighborhood = $request->neighborhood;
        $event->complement = $request->complement;
        $event->city = $request->city;
        $event->state = $request->state;
        $event->batch = $request->batch;
        $event->is_free = $request->is_free ? true : false;
        $event->save();

        if ($request->id && $request->is_free) {
            $ticketTypes = TicketType::where('event_id', $event->id)->get();
            if ($ticketTypes) {
                foreach ($ticketTypes as $ticketType) {

                    $freeBatch = TicketBatch::where('ticket_type_id', $ticketType->id)->where('name', 'Gratuito')->first();
                    if (!$freeBatch) {
                        $freeBatch = new TicketBatch;
                    }
                    $freeBatch->name = "Gratuito";
                    $freeBatch->batch = 0;
                    $freeBatch->price = 0;
                    $freeBatch->ticket_type_id = $ticketType->id;
                    $freeBatch->save();
                }
            }
        }
        if ($request->id && !$request->is_free) {
            $ticketTypes = TicketType::where('event_id', $event->id)->get();
            if ($ticketTypes) {
                foreach ($ticketTypes as $ticketType) {
                    $freeBatch = TicketBatch::where('ticket_type_id', $ticketType->id)->where('name', 'Gratuito')->first();
                    if ($freeBatch) {
                        $freeBatch->delete();
                    }
                }
            }
        }

        return redirect()->route('panel.events.index')->withSuccess($request->id ? "Evento atualizado com sucesso" : "Evento cadastrado com sucesso");
    }


    public function createOrEdit($id = null)
    {
        //há dois findOrNew nesses códigos um para saber se o botão ira criar/atualizar, este segundo findOrNew se há um ID irá preencher os campos vázios do form para fazer a att
        $event = Event::findOrNew($id);


        return $this->form($event); //aqui encaminha a pessoa para o Form com os dados para serem atualizados
    }

    private function form(Event $event)
    {
        $image = asset($event->image_path);
        return view('events.form', [
            'event' => $event,
        ]);
    }

    public function searchEvents(Request $request)
    {

        $events = Event::search($request)->select('id')->orderBy('id', 'desc')->get();

        $data = [
            "events" => $events
        ];

        return $data;
    }


    public function getEvents(Request $request)
    {
        return Event::select('id', 'name as text')->where('name', 'ilike', '%' . $request->search . '%')->limit(5)->get();
    }


    public function subscribe(Request $request)
    {
        //Valida se a pessoa na verdade já não está inscrita.
        $ticket_types_from_event = DB::table('ticket_types')->where('event_id', $request->event_id)->get('id')->pluck('id')->toArray(); // pode ser nulo
        $ticket_batches = $ticket_types_from_event == NULL ? [] : DB::table('ticket_batches')->whereIn('ticket_type_id', $ticket_types_from_event)->get('id')->pluck('id')->toArray(); //poder ser vazio
        $is_subscribed = DB::table('tickets')->where('user_id', Auth::user()->id)->whereIn('ticket_batch_id', $ticket_batches)->get()->toArray() == [] ? false : true;

        if ($is_subscribed) {
            return redirect(url('eventos/' . $request->event_id))->withErrors("Você já está inscrito nesse evento!");
        }

        //Pega um ticket type do evento, se não houver, cria um ticket type
        $ticket_type = DB::table('ticket_types')->where('event_id', $request->event_id)->first();
        $ticket_type_id = $ticket_type != NULL ? $ticket_type->id : NULL;
        if ($ticket_type == NULL) {
            $ticket_type = new TicketType;
            $ticket_type->name = "Cortesia";
            $ticket_type->event_id = $request->event_id;
            $ticket_type->save();
            $ticket_type_id = DB::table('ticket_types')->where('event_id', $request->event_id)->first()->id;
        }

        $ticket_batch = DB::table('ticket_batches')->where('batch', 0)->where('ticket_type_id', $ticket_type_id)->get()->first();

        if (!$ticket_batch) {
            $ticket_batch = new TicketBatch;
            $ticket_batch->name = "Cortesia";
            $ticket_batch->batch = 0;
            $ticket_batch->price = 0;
            $ticket_batch->ticket_type_id = $ticket_type_id;
            $ticket_batch->save();
        }

        $ticket = new Ticket;

        $ticket->owner_name = Auth::user()->name;
        $ticket->owner_cpf = Auth::user()->cpf;
        $ticket->user_id = Auth::user()->id;
        $ticket->transaction_id = 0;
        $ticket->ticket_batch_id = $ticket_batch->id;

        $ticket->save();

        return redirect(url('eventos/' . $request->event_id));
    }
}
