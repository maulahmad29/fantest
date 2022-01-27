<?php

namespace Database\Seeders;

use App\Models\Epresence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class DataFirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        Epresence::truncate();

        $userJson = File::get("database/data/user.json");
        $userData = json_decode($userJson);

        foreach($userData as $row)
        {

            $db = new User();

            $db->name = $row->name;
            $db->email = $row->email;
            $db->password = bcrypt($row->email);
            $db->npp = $row->npp;
            $db->npp_supervisor = $row->npp_supervisor;
            $db->save();
        }

        $esprenceJson = File::get("database/data/epresence.json");
        $esprenceData = json_decode($esprenceJson);

        foreach($esprenceData as $i=>$row)
        {

            $db = new Epresence();

            $db->id_users = $row->id_users;
            $db->type = $row->type;
            $db->is_approve = $row->is_approve;

            if($i > 0)
            {
                
                $db->waktu = Carbon::now()->addHours(1);
            }
            else
            {
                $db->waktu = Carbon::now();
            }

            $db->save();
        }

    }
}
