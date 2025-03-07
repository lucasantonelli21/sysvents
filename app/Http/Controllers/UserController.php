<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showRegister(){
        return view('users.register');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | unique:users',
            'cpf' => 'required | unique:users',
            'birth_date' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ],[
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        $validator->after(function ($validator) use($request) {
            if($request->password != $request->password_confirmation){
                $validator->errors()->add($request->password,'Sua senha deve ser igual a confirmação de senha!');
            }
        });
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->birth_date = $request->birth_date;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->is_admin = false;
        $user->save();
        return redirect()->route('admin.dashboard')->withSucces('Logado com Sucesso!');
    }
}
