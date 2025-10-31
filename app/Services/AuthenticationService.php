<?php

namespace App\Services;

use App\Models\User;
use App\Models\Login;
use App\Repositories\Interfaces\UserRepo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AuthenticationService {
    public function __construct(private UserRepo $repo,private JwtService $jwt){

    }
    public function attemptLogin(Login $login){
    $user=$this->repo->getUserByEmail($login->getEpost());

    if ($user && Hash::check($login->getLosenord(), $user->losenord)) {
        return $user;
    }
    return null;
    } 

    /**
     * Refreshtoken har lång livslängd
     * @param User $user
     * @return string
     * @throws \Random\RandomException
     */

    public function createAccessTokensForUser(User $user):string{
        $claims=[
            'sub'=>(string) $user->id,
            'email'=>$user->email,
            'roles'=> $user->admin ? ['admin']:[]
        ];

        return $this->jwt->makeAccessToken($claims);
    }
    public function createAndStoreRefreshToken(User $user):string{
        $raw=bin2hex(random_bytes(20));
        $hash=hash('SHA256', $raw);
        $expiresAt=Carbon::now()->addSeconds(env('REFRESH_TTL', 10000));
        $user->refresh_token_hash=$hash;
        $user->refresh_token_expires_at=$expiresAt->toDateTimeString();

        //uppdatera användaren
        $this->repo->update($user);
        return $raw;
    }
    public function validateRefreshTokenAndGetUser(string $rawToken):?User{
        $hash=hash('SHA256', $rawToken);
        $user=$this->repo->findUserByRefreshToken($hash);

        if(!$user){
            return null;
        }

        if ($user->refresh_token_expires_at && strtotime($user->refresh_token_expires_at)<time()) {
            return null;
        }
        return $user;
    }
    public function revokeRefreshToken(User $user){
        $user->refresh_token_hash=null;
        $user->refresh_token_expires_at=null;
        $this->repo->update($user);
    }
}