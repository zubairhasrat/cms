<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
class CustomAuthController extends Controller
{
    public function register(Request $request){
        // $this.validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6',
        // ]);

        $user = User::create($request->all());

        return ["message"=>"user created","user"=>$user];
    }
    public function login(Request $request){
        $crediential = $request->only('email','password');
        if(!$token = JWTAuth::attempt($crediential)){
            return "not authenticated";
        }
        return ['token' => $token];
    }
}
