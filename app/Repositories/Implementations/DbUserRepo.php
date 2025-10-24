<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepo;

class DbUserRepo implements UserRepo{
    public function all() :array {return User::all()->all();}

    public function get(string $id):?User{
        return User::findOrFail($id);
    }

    public function add(User $user):void{
        $user->save();
    }

     public function update(User $user):void{
        $user->update();
    }

     public function delete(string $id):void{
        User::destroy($id);
    }
    public function getUserByEmail(string $email):?User{
        return User::query()->where('epost', $email)->firstOrFail();
    }
}