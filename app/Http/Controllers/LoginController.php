<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\Login;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;


class LoginController extends Controller{


    public function show(){
        return View::make('login');
    }

    public function login(Request $request, AuthenticationService $auth) {
        //skapa login objekt
        $login=Login::create($request->request->all());

        //kolla data
        $user=$auth->attemptLogin($login);
        //returnera inloggningen om lyckas
        if ($user) {
            //return lyckas
            $request->session()->put('user_id',$user->id);
            $request->session()->save();
            return redirect("/{$user->namn}");
            
        } else {
            //return misslyckad
            return View::make('login', ['message'=>'Fel epost eller lösenord']);
        }
        
    }
}
