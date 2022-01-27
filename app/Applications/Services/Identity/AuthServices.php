<?php

namespace App\Applications\Services\Identity;

use App\Applications\Interfaces\Identity\IAuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServices implements IAuthServices
{
    public  function Login(Request $req)
    {

        $email = $req->email;
        $password = $req->password;

        $credential = [
            'email' => $email, 
            'password' => $password
        ];

        if(Auth::attempt($credential))
        {
         
            $accessToken = auth()->user()->createToken('Foobar')->accessToken;

            // dd($accessToken);

            return response(['access_token' => $accessToken]);

        }
        else
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    public function Logout(Request $req)
    {
        $token = $req->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}