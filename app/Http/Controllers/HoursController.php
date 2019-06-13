<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\ Http\Request;

class HoursController extends Controller
{
    public function get_in($id){
        $lastGetIn = $this->get_last_get_in($id); //Obtiene la ultima entrada del usuario
        if($lastGetIn != false){
            $currentDate = Carbon::now()->toDateString(); 
            $store_get_id = $this->validate_get_in($lastGetIn,$currentDate);
            if($store_get_id){
                  DB::table("hours")->insert([
                      "user_id" => $id,
                      "fecha" => Carbon::now()->toDateString(),
                      "hora_entrada" => Carbon::now()->toTimeString(),
                  ]);
            }
        }
        return redirect()->route("users.index");
    }

    public function get_out($id){
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        //se encuantra el ultimo registro
        $hours_id = DB::table("hours")
        ->where([
            "user_id" => $id,
            "fecha" => $currentDate,
            // "hora_salida" => null,
        ])->max("hours_id");

        //se actualiza hora de salida
        DB::table("hours")
        ->where([
            "hours_id" => $hours_id,
            "hora_salida" => null
        ])->update(["hora_salida"=>$currentTime]);

        return redirect()->route("users.index");
    }

    //CONSIGUE EL ID DE LA ULTIMA ENRTADA DE UN USUARIO
    private function get_last_id($id){
        return DB::select('select max(hours_id) as last_id from hours where user_id = :id', ['id' => $id]);
    }

    //REGRESA REGISTRO DE LA ULTIMA ENTRADA DE UN USUARIO
    private function get_last_get_in($idUser){
        $lastID = $this->get_last_id($idUser);
        $lastID = json_decode(json_encode($lastID[0]),true);
        if($lastID["last_id"]){
            $last_get_in = DB::table("hours")->
                where("hours_id",$lastID)->
            get();
            return $last_get_in = json_decode(json_encode($last_get_in[0]),true);
        }
        else
            return $last_get_in = false;
    }

    public function validate_get_in($lastGetIn, $currentDate){
        if($lastGetIn["fecha"] ==  $currentDate && $lastGetIn["hora_salida"] == null)
            return false;
        else
            return true;
    }

    //SE UTILIZA EN LA VISTA INDEX PARA DETERMINAR SI MOSTRAR O NO, UN BOTON
    public function show_get_in_btn($idUSer){
        $lastGetIn = $this->get_last_get_in($idUser);
        $currentDate = Carbon::now()->toDateString(); 
        $showBtn = $this->validate_get_in($lastGetIn, $currentDate);
        return $showBtn;
    }

    public function get_total_hours($userId){
        $user = DB::table("users")->where("id", $userId)->first();
        $tiempoTotal = DB::table("hours")
        ->select(DB::raw("SUM(TIME_TO_SEC(TIMEDIFF(hora_salida,hora_entrada))) as tiempo"))
        ->where("user_id",$userId)
        ->where("hora_salida","<>","NULL")
        ->get();

        $tiempoTotal = intval($tiempoTotal[0]->tiempo);

        $horas = floor($tiempoTotal / 3600);
        $minutos = floor(($tiempoTotal - ($horas * 3600)) / 60);
        $segundos = $tiempoTotal - ($horas * 3600) - ($minutos * 60);
        if($horas<10)
            $horas = "0".$horas;
        if($minutos<10)
            $minutos = "0".$minutos;
        $tiempoTotal = $horas . ':' . $minutos;
        return $tiempoTotal;
    }
}
