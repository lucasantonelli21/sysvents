<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::search($request)->orderBy('id', 'desc')->paginate($request->pagination ?? 10)->withQueryString();
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function form(User $user)
    {
        return view(
            'users.register',
            [
                "user" => $user
            ]
        );
    }


    public function createOrEdit($id = null)
    {
        $user = User::findOrNew($id);
        return $this->form($user);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>  ['required', Rule::unique('users')->ignore($request->id)],
            'cpf' =>    ['required', Rule::unique('users')->ignore($request->id)],
            'birth_date' => 'required',
            'phone' => 'required',
        ], [
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        $validator->after(function ($validator) use ($request) {
            if ($request->show_password) {
                if ($request->new_password == '') {
                    $validator->errors()->add($request->new_password, 'Você deve preencher o campo da sua nova senha!');
                }

                if ($request->password_confirmation == '') {
                    $validator->errors()->add($request->password_confirmation, 'Você deve confirmar sua senha!');
                }

                if ($request->new_password != $request->password_confirmation) {
                    $validator->errors()->add($request->new_password, 'Sua nova senha deve ser igual a confirmação de senha!');
                }

                if (!Hash::check($request->password, Auth::user()->password)) {
                    $validator->errors()->add($request->password, 'Senha antiga inválida!');
                }
            } else {
                if ($request->password != $request->password_confirmation) {
                    $validator->errors()->add($request->password, 'Sua senha deve ser igual a confirmação de senha!');
                }
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::findOrNew($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->birth_date = $request->birth_date;
        $user->phone = $request->phone;
        if (!$user->id) {
            $user->password = Hash::make($request->password);
        } else {
            if ($request->show_password) {
                $user->password = Hash::make($request->new_password);
            }
        }
        $user->is_admin = $request->is_admin ? $request->is_admin : true;
        $user->save();

        if (!$request->id && !Auth::check()) {
            $credentials = [
                "email" => $request->email,
                "password" => $request->password
            ];

            Auth::attempt($credentials, false);
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard')->withSuccess('Login realizado com sucesso! Bem-Vindo ' . Auth::user()->name);
            }

            return redirect()->route('home')->withSucces('Logado com Sucesso! Bem-Vindo' . Auth::user()->name);
        }
        if (!$request->id) {
            return redirect()->route('users.home')->withSuccess('Usuário ' . $user->name . ' Criado com Successo!');
        }
        if ($request->id && Auth::user()->is_admin){
            return redirect()->route('users.home')->withSuccess('Usuário ' . $user->name . ' Atualizado com Successo!');
        }
        return redirect()->route('home')->withSuccess('Usuário ' . $user->name . ' Atualizado com Successo!');
    }

    public function delete(int $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route("users.home")->withSuccess("Usuário deletado com sucesso!");
        }
        return redirect()->route("users.home")->withErrors("Não foi encontrado nenhum usuário com este id");
    }
}
