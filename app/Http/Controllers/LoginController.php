<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, false)) {
            $request->session()->regenerate();

            if(Auth::user()->is_admin){
                return redirect()->route('admin.dashboard')->withSuccess('Login realizado com sucesso! Bem-vindo, '.Auth::user()->name.'.');
            }
            return redirect()->route('admin.dashboard')->withSuccess('Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais apresentadas não batem com nossos registros.',
        ])->onlyInput('email');
    }


    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('home')->withSuccess('Logout realizado com sucesso!');
        }else{
            return redirect()->route('home');
        }
    }
}
