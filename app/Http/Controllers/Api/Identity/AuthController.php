<?php

namespace App\Http\Controllers\Api\Identity;

use App\Applications\Interfaces\Identity\IAuthServices;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected IAuthServices $autServices;

    public function __construct(IAuthServices $autServices)
    {
        $this->autServices = $autServices;
    }

    public function login(Request $req)
    {
        
        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        else
        {
           return $this->autServices->Login($req);
        }
    }
}
