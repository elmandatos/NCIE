<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        // $user = DB::table("users")->where([
        //     "email" => $request->all()["email"],
        //     "password" => bcrypt($request->all()["password"]),
        // ])->get();        
        $user = DB::table("users")->where([
            "email" => "NONE@gmail.com",
            "password" => bcrypt("1234"),
        ])->get();        
        var_dump($user);
    }
}
