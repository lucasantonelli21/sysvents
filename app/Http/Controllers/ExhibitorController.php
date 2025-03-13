<?php

namespace App\Http\Controllers;

use App\Models\Exhibitor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ExhibitorController extends Controller
{
    public function index(Request $request)
    {
        $exhibitors = Exhibitor::search($request)->orderBy('id', 'desc')->paginate($request->pagination ?? 10)->withQueryString();

        return view('exhibitors.index', [
            'exhibitors' => $exhibitors
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category' => 'required|',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())
                ->withInput();
        }

        // Este findOrNew sera oque vai decidir se o Botão ira atulizar ou criar um novo filme
        $exhibitor = Exhibitor::findOrNew($request->id); // Esse $request->id é uma ação Hidden que faz no HTML para armazenar o ID caso tenha, se tiver em vez de criar um novo filme é apenas recuperado as informações para fazer a att
        $exhibitor->name = $request->name;
        $exhibitor->description = $request->description;
        $exhibitor->category = $request->category;

        $exhibitor->save();

        return redirect()->route('panel.exhibitors.index')->withSuccess($request->id ? "Expositor atualizado com sucesso" : "Expositor cadastrado com sucesso");;
    }

    public function delete($id) // em cada filme listado no index há um botão delete por ter um botao delete por filme, logo o botão delete é vinculado ao ID desse filme
    //como o botao delete sabe o ID do filme?
    {
        try {
            $exhibitor = Exhibitor::find($id);
            if ($exhibitor == null) {
                return redirect()->route('panel.exhibitors.index')->withErrors("Erro ao deletar o Expositor");
            } else {
                $exhibitor->delete();
                return redirect()->route('panel.exhibitors.index')->withSuccess("Expositor deletado com sucesso!");
            }
        } catch (\Throwable $th) {
        }
    }

    public function createOrEdit($id = null)
    {
        //há dois findOrNew nesses códigos um para saber se o botão ira criar/atualizar, este segundo findOrNew se há um ID irá preencher os campos vázios do form para fazer a att
        $exhibitor = Exhibitor::findOrNew($id);


        return $this->form($exhibitor); //aqui encaminha a pessoa para o Form com os dados para serem atualizados
    }

    private function form(Exhibitor $exhibitor) //Aqui não deveria ter um ($movie = null)?
    {
        return view('exhibitors.form', [
            'exhibitor' => $exhibitor
        ]);
    }
}
