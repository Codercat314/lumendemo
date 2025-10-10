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
        $user=User::factory() ->make($request->request->all());
        $this->repo->add($user);
        return redirect('/anvandare');
    }

    public function showUser(Request $request){
        $id=$request->route('id');
        $user=$this->repo->get($id);

        return View::make('user', ['user'=>$user]);
    }

    public function modifyUser(Request $request){
        $id = $request->route('id');
        if ($request->request->get('delete')) {
            
            $this->repo->delete($id);
        }else{
            $user=$this->repo->get($id);
            $user->fill($request->request->all());
            $this->repo->update($user);
        }
        return redirect('/anvandare');
    }
}
