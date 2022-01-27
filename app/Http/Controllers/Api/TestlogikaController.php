<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestlogikaController extends Controller
{
    public function soalSatu(Request $req)
    {
        
        $arr = $req->sampel;

        $sum = array_sum(array_map(function($v) { return floor($v / 2); }, array_count_values($arr)));

        $toInt = (int)$sum;

        return response()->json($toInt);

    }

    public function soalDua(Request $req)
    {
        $word = $req->word;

        $cek = explode(' ', $word);
        $total = count($cek);

        $c = 0;

        foreach($cek as $i => $row)
        {

            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $row))
            {
               
                continue;
            }
            else
            {
                $c++;
            }
        }

        $min = $c;

        return response()->json($min);
    }
}
