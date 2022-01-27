<?php

namespace App\Applications\Services\UseCase;

use App\Applications\Interfaces\UseCase\IApprovalEpresenceServices;
use App\Applications\Response\BaseResponse;
use App\Models\Epresence;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalEpresenceServices implements IApprovalEpresenceServices
{
    public function Approve(Request $req)
    {
        $resp = new BaseResponse();

        try{



            $db = Epresence::find($req->id);

            $userCek = User::find($db->id_users);

            if($userCek->npp_supervisor == null)
            {
                if($userCek->id_users == Auth::guard('api')->user()->id )
                {
                    $db->is_approve = $req->is_approve;
                    $db->save();

                    $resp->message = "Success";
                    $resp->success = true;
                    $resp->code = 200;
                }
                else
                {
                    $resp->message = "Only the supervisor himself can approve";
                    $resp->success = false;
                    $resp->code = 400;
                }
            }
            else
            {
                if($userCek->npp_supervisor == Auth::guard('api')->user()->npp )
                {
                    $db->is_approve = $req->is_approve;
                    $db->save();
    
                    $resp->message = "Success";
                    $resp->success = true;
                    $resp->code = 200;
                }
                else
                {
                    $resp->message = "You do not have permission to approve";
                    $resp->success = true;
                    $resp->code = 200;
                }
            }
          

        }
        catch(Exception $ex)
        {
            $resp->success = false;
            $resp->message = $ex->getMessage();
            $resp->code = 400;
        }
        
        return $resp;
    }
}
