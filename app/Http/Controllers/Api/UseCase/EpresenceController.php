<?php

namespace App\Http\Controllers\Api\UseCase;

use App\Applications\Interfaces\UseCase\IEpresenceServices;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EpresenceController extends Controller
{
    protected IEpresenceServices $epresenceServices;

    public function __construct(IEpresenceServices $epresenceServices)
    {
        $this->epresenceServices = $epresenceServices;
    }


    public function get($id)
    {
        $resp = $this->epresenceServices->Get($id);

        return response()->json($resp);
    }

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'waktu' => 'required',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        else
        {
            $resp = $this->epresenceServices->Post($req);

            return response()->json($resp);
        }

      
    }
}
