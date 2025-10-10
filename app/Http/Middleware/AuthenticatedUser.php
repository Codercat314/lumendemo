<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\UserRepo;

class AuthenticatedUser{

    public function __construct(private UserRepo $repo){

    }

    public function handle($request, \Closure $next){
        if (!$request->session()->has('user_id')) {
            //användare ej inloggad redirekt till login sida
            return redirect('/login')/*->with('errors', ['Du måste logga in först'])*/;
        }

        //hämta användare
        $user = $this->repo->get($request->session()->get('user_id'));
        if (!$user) {
            throw new BadRequestException('User not found in database');
        }

        $request->setUserResolver(fn() => $user);
        return $next($request);
    }
}