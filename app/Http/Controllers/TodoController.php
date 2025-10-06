<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Uppgift;

class TodoController extends Controller {
    public function __construct(private UppgiftRepo $repo){

    }
    function show(){
       // $lista = ['Cykla', 'Sova', 'Andas', "Äta"];
        $lista = $this->repo-> all();
        return View::make('todo', ['lista' => $lista]);
    }

    function add(Request $request){
        
        $text=$request-> request->get('uppgift');
        $uppgift = Uppgift::factory()->make(['text'=>$text, 'done'=>false]);

        $this-> repo->add($uppgift);

        $lista = $this->repo->all();
        return View::make('todo', ['lista' => $lista]);
    }
    function remove(Request $request){
        //dd($request->all());
        //$lista=json_decode($request->request->get('lista'));
        
        $id=$request->request->get('uppgift');
        $this ->repo->delete($id);

        $lista = $this->repo->all();
        
        return View::make('todo', ['lista' => $lista]);
    }
}