<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $data = [
            'event' => $event
        ];

        return view('events.event', $data);
    }

    public function delete($id) // em cada filme listado no index há um botão delete por ter um botao delete por filme, logo o botão delete é vinculado ao ID desse filme
    //como o botao delete sabe o ID do filme?
    {
        try {
            $event = Event::find($id);
            if ($event == null) {
                return redirect()->route('events.index')->withErrors("Erro ao deletar o Expositor");
            } else {
                $event->delete();
                return redirect()->route('events.index')->withSuccess("Expositor deletado com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }

    public function save(Request $request)
    {
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

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())
                ->withInput();
        }

        $event = Event::findOrNew($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->theme = $request->theme;
        $event->longitude = $request->longitude;
        $event->latitude = $request->latitude;
        $event->batch = $request->batch;

        $event->save();

        return redirect()->route('events.index')->withSuccess($request->id ? "Expositor atualizado com sucesso" : "Expositor cadastrado com sucesso");;
    }
    public function createOrEdit($id = null)
    {
        //há dois findOrNew nesses códigos um para saber se o botão ira criar/atualizar, este segundo findOrNew se há um ID irá preencher os campos vázios do form para fazer a att
        $event = Event::findOrNew($id);


        return $this->form($event); //aqui encaminha a pessoa para o Form com os dados para serem atualizados
    }

    private function form(Event $event) //Aqui não deveria ter um ($movie = null)?
    {

        // $teste = new Carbon();

        // $event->start_date = new Carbon($event->start_date);

        // dd($event, $teste->format("d/m/Y H:m:s"));

        return view('events.form', [
            'event' => $event
        ]);
    }
}
