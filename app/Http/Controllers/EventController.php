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

    public function showEvent($id) {
        $event = Event::findOrFail($id);

        $ticket_types = DB::table('ticket_types')->leftJoin('ticket_batches', 'ticket_types.id', 'ticket_batches.ticket_type_id')->where('ticket_types.event_id', $event->id)->where('ticket_batches.batch', $event->batch)
        ->select("ticket_types.*", "ticket_batches.price")->get();
        if(Auth::check()) {
            //Verifica se o usuário já está inscrito no evento.
            $ticket_types_id = $ticket_types->pluck('id')->toArray();
            $ticket_batches = $ticket_types_id == NULL ? [] : DB::table('ticket_batches')->whereIn('ticket_type_id', $ticket_types_id)->get('id')->pluck('id')->toArray(); //poder ser vazio
            $is_subscribed = DB::table('tickets')->where('user_id', Auth::user()->id)->whereIn('ticket_batch_id', $ticket_batches)->get()->toArray() == [] ? false : true;
        }else {
            $is_subscribed = false;
        }

        $data = [
            'event' => $event,
            'ticket_types' => $ticket_types,
            'is_subscribed' => $is_subscribed
        ];

        // dd($ticket_types);

        return view('events.event', $data);
    }

    public function showLibrary(Request $request) {

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
                $event->delete();
                return redirect()->route('panel.events.index')->withSuccess("Evento deletado com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }

    public function save(Request $request)
    {
        if(!$request->id){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'theme' => 'required|',
                // 'longitude' =>'required',
                // 'latitude' =>'required',
                'batch' =>'required',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'description' => 'required|string|min:10',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'theme' => 'required|',
                    'longitude' =>'required',
                    'latitude' =>'required',
                    'batch' =>'required',
                    ]);
            }

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())
                ->withInput();
        }

        $event = Event::findOrNew($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        if($request->image_path){
            $filename =  'images/' . time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images/'), $filename);
            $event->image_path = $filename;
        }
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->theme = $request->theme;
        $event->longitude = $request->longitude;
        $event->latitude = $request->latitude;
        $event->batch = $request->batch;

        $event->save();

        return redirect()->route('panel.events.index')->withSuccess($request->id ? "Expositor atualizado com sucesso" : "Expositor cadastrado com sucesso");;
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
            'event' => $event
        ]);
    }

    public function searchEvents(Request $request) {

        $events = Event::search($request)->select('id')->orderBy('id', 'desc')->get();

        $data = [
            "events" => $events
        ];

        return $data;

    }


    public function getEvents(Request $request){
        return Event::select('id','name as text')->where('name', 'ilike', '%'.$request->search.'%')->limit(5)->get();
    }


    public function subscribe(Request $request) {
        $ticket_types_amount = [];
        foreach($request->toArray() as $key => $value) {
            if($key == "_token" || $key == "event_id") continue;
            if(substr($key, 0, 18) == "ticketAmountOfType") {
                $ticket_types_amount[substr($key, 18, strlen($key))] = $value;
            }else {
                return redirect(url('eventos/'.$request->event_id))->withErrors("Não foi possível comprar o(s) ingresso(s), por favor tente novamente mais tarde.");
            };
            //Verificar se o ticketType que está sendo comprado realmente é daquele evento
            try {
                $ticket_type = TicketType::findOrFail(substr($key, 18, strlen($key)));
                if($ticket_type->event_id != $request->event_id) {
                    return redirect(url('eventos/'.$request->event_id))->withErrors("Não foi possível comprar o(s) ingresso(s), por favor tente novamente mais tarde.");
                }

            } catch (\Throwable $th) {
                return redirect(url('eventos/'.$request->event_id))->withErrors("Não foi possível comprar o(s) ingresso(s), por favor tente novamente mais tarde.");
            }

        }

        foreach($ticket_types_amount as $id => $amount) {
            for($i = 0; $i < $amount; $i++) {
                $ticket = new Ticket;

                $ticket->owner_name = Auth::user()->name;
                $ticket->owner_cpf = Auth::user()->cpf;
                $ticket->user_id = Auth::user()->id;
                $ticket->transaction_id = 0;
                $ticket->ticket_batch_id = DB::table('ticket_batches')->where('batch', 0)->where('ticket_type_id', $id)->get()->first()->id;
                $ticket->save();
            }
        }

        return redirect(url('eventos/'.$request->event_id))->withSuccess("Compra realizada com sucesso.");;

    }

}
