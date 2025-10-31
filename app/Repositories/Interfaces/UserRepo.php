<?php
namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepo {

    //User[]
    public function all():array;

    public function get(string $id):?User;

    public function add(User $User):void;

    public function update(User $User):void;

    public function delete(string $id):void;
    
    public function getUserByEmail(string $email):?User;
    
    public function findUserByRefreshToken(string $email):?User;
}