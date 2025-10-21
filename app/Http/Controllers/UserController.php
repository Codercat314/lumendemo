<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\UserRepo;

class UserController extends Controller{
public function __construct(private UserRepo $repo){

}

    function show(Request $request){
        $lista=$this->repo->all();

        //Hämta inloggad användare
        $me = $request->user();
        return View::make('user', ['lista'=>$lista, 'me'=>$me]);
    }

    function add(Request $request){
        //bara admin ska kunna lägga till användare
        $me=$request->user();
        if (!$me->admin) {
            return View::make('ajabaja');
        }
        $user=User::factory() ->make($request->request->all());
        $this->repo->add($user);
        return redirect('/anvandare');
    }

    public function showUser(Request $request){
        $id=$request->route('id');
        $user=$this->repo->get($id);
         //Hämta inloggad användare
        $me = $request->user();
        if (($me->admin || isset($user)) && $user->id==$me->id) {
            return View::make('user', ['user'=>$user, 'me'=>$me]);
            # code...
        } else {
            //aja-baja
            return View::make('ajabaja');
        }

    }

    public function modifyUser(Request $request){
        //hämta inloggad admin
        $me=$request->user();
        
        
        $id = $request->route('id');
        if ($request->request->has('delete') && ($id==$me -> id || $me->admin)) {
            return View::make('ajabaja');    
        }

        if ($id!=$request->request->get('id')) {
            # code...
            return View::make('ajabaja');
        }
        if ($request->request->has('delete')) {
            # code...
            $this->repo->delete($id);
        }else{
        
            $user=$this->repo->get($id);
            $user->fill($request->request->all());
            if (!$me->admin) {
                $user->admin=0;
            }
            $this->repo->update($user);
        }
        return redirect('/anvandare');
    }
}
