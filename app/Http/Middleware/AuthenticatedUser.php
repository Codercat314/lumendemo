<?php

namespace App\Http\Middleware;

class AuthenticatedUser{
    public function handle($request, \Closure $next){
        if (!$request->session()->has('user_id')) {
            //användare ej inloggad redirekt till login sida
            return redirect('/login')/*->with('errors', ['Du måste logga in först'])*/;
        }
        return $next($request);
    }
}