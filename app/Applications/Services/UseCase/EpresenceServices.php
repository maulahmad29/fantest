<?php

namespace App\Applications\Services\UseCase;

use App\Applications\Interfaces\UseCase\IEpresenceServices;
use App\Applications\Response\BaseResponse;
use App\Models\Epresence;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EpresenceServices implements IEpresenceServices
{
    public function Get($id)
    {
        $resp = new BaseResponse();

        try
        {
            $que = Epresence::where('id_users', $id)->select(DB::raw('DATE(waktu) as tanggal'))
                ->groupBy('tanggal')
                ->get();
            
            $obj = [];

            if(count($que) > 0)
            {
                $User = User::find($id);

                foreach($que as $row)
                {
    
                    $newObj = collect([
                        'id_users' => $User->id,
                        'nama_users' => $User->name,
                        'tanggal' => $row->tanggal
                    ]);
    
                    
                    $statusMasuk = "REJECT";
                    $statusPulang = "REJECT";
    
                    $cekIn = Epresence::whereDate('waktu', $row->tanggal)
                        ->where('type', 'IN')->first();
    
                    if($cekIn)
                    {
                        if($cekIn->is_approve)
                        {
                            $statusMasuk = "APPROVE";
                        }
                        
    
                        $newObj->put('waktu_masuk', Carbon::parse($cekIn->waktu)->format('H:i:s'));
                    }
                    else
                    {
                        $newObj->put('waktu_masuk', null);
                    }
    
                    $cekOut = Epresence::whereDate('waktu', $row->tanggal)
                    ->where('type', 'OUT')->first();
    
                    if($cekOut)
                    {
                        if($cekOut->is_approve)
                        {
                            $statusPulang = "APPROVE";
                        }
    
                        $newObj->put('waktu_pulang', Carbon::parse($cekOut->waktu)->format('H:i:s'));
                    }
                    else
                    {
                        $newObj->put('waktu_pulang', null);
                    }
    
                    $newObj->put('status_masuk', $statusMasuk);
                    $newObj->put('status_pulang', $statusPulang);
    
    
                    $obj[] = $newObj;
    
                }

                $resp->data = $obj;
                $resp->message = "Success get data";
                $resp->success = true;
                $resp->code = 200;
            }
            else
            {
                $resp->message = "No data";
                $resp->success = true;
                $resp->code = 200;
            }
            
           
            

        
        }
        catch(Exception $ex) {
            $resp->success = false;
            $resp->message = $ex->getMessage();
            $resp->code = 400;
        }

        return $resp;
    }
    
    public function Post(Request $req)
    {
        $resp = new BaseResponse();

        try {

            $date = Carbon::parse($req->waktu)->format('Y-m-d');

            $cek = Epresence::whereDate('waktu', $date)->get();


            if(count($cek) < 1)
            {
                $req->type = "IN";
            }
            if(count($cek) > 0)
            {
                $req->type = "OUT";
            }

            if(count($cek) >= 2)
            {
                $resp->message = "Opps cant do more than 2";
                $resp->success = true;
                $resp->code = 200;
                return $resp;
            }

            $db = new Epresence();

            $db->type = $req->type;
            $db->waktu = $req->waktu;
            $db->id_users = Auth::guard('api')->user()->id;
            $db->save();

            $resp->message = "Success";
            $resp->success = true;
            $resp->code = 200;
            return $resp;

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