<?php

namespace App\Applications\Interfaces\UseCase;

use Illuminate\Http\Request;

interface IApprovalEpresenceServices
{
    public function Approve(Request $req);
}