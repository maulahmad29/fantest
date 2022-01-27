<?php

namespace App\Http\Controllers\Api\UseCase;

use App\Applications\Interfaces\UseCase\IApprovalEpresenceServices;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalEpresenceController extends Controller
{
    protected IApprovalEpresenceServices $approvalServices;

    public function __construct(IApprovalEpresenceServices $approvalServices)
    {
        $this->approvalServices = $approvalServices;
    }

    public function approve(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'is_approve' => 'required',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        else
        {
            $resp = $this->approvalServices->Approve($req);

            return response()->json($resp);
        }
    }
}
