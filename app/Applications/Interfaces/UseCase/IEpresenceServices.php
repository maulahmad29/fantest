<?php

namespace App\Applications\Interfaces\UseCase;

use Illuminate\Http\Request;

interface IEpresenceServices {
    public function Get($id);
    public function Post(Request $req);
}