<?php

namespace App\Applications\Interfaces\Identity;

use Illuminate\Http\Request;

interface IAuthServices {
    public function Login(Request $req);
    public function Logout(Request $req);
}