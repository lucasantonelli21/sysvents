<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArtistController extends Controller
{

    public function index(Request $request){
        $artists = Artist::search($request)->orderBy('id','DESC')->paginate($request->pagination ?? 10);
        return view('artists.index',["artists" => $artists]);
    }

    public function createOrEdit($id = null)
    {
        $artist = Artist::findOrNew($id);
        return $this->form($artist);
    }

    public function form(Artist $artist)
    {
        return view('artists.form', ["artist" => $artist]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birth_date' =>  'required',
            'fee' =>    'required',
            'phone' => ['required', Rule::unique('artists')->ignore($request->id)],
        ], [
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $artist = Artist::findOrNew($request->id);
        $artist->name = $request->name;
        $artist->birth_date = $request->birth_date;
        $artist->fee = $request->fee;
        $artist->phone = $request->phone;
        $artist->save();

        if (!$request->id) {
            return redirect()->route('artists.index')->withSuccess('Artista ' . $artist->name . ' Criado com Successo!');
        }
        return redirect()->route('artists.index')->withSuccess('Artista ' . $artist->name . ' Atualizado com Successo!');
    }

    public function delete(int $id)
    {
        $artist = Artist::find($id);
        if ($artist) {
            $artist->delete();
            return redirect()->route("artists.index")->withSuccess("Artista deletado com sucesso!");
        }
        return redirect()->route("artists.index")->withErrors("Não foi encontrado nenhum artista com este id");
    }
}
