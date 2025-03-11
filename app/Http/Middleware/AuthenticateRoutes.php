<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if (Auth::User()->is_admin){
                return $next($request);
            }else{
                return redirect()->route('home')->withErrors('Função disponível apenas para Administradores!');
            }
        }else{
            return redirect()->route('home')->withErrors('Você precisa se logar antes!');
        }
    }
}
