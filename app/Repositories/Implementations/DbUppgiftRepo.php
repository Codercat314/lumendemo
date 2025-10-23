<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;

class DbUppgiftRepo implements UppgiftRepo{
    public function all() :array {return Uppgift::all()->toArray();}

    public function get(string $id):?Uppgift{
        return Uppgift::findOrFail($id);
    }

    public function add(Uppgift $uppgift):void{
        $uppgift->save();
    }

     public function update(Uppgift $uppgift):void{
        $uppgift->update();
    }

     public function delete(string $id):void{
        Uppgift::destroy($id);
    }
}