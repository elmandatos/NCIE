<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $user = DB::table("users")->where([
            "email" => $data["email"],
        ])->first();  
        if($user){
            $user = json_decode(json_encode($user),true);
            if(Hash::check($data["password"], $user["password"]))
                return response()->json($user,200);
            else
                return response()->json(["message" => "CONTRASEÑA INVALIDA"],401);     
        }
        else
            return response()->json(["message" => "CORREO NO ENCONTRADO"],500);     
    }
}
