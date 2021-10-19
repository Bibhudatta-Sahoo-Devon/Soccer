<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class APIController extends Controller
{

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid Credentials!'
            ],Response::HTTP_UNAUTHORIZED);
        }
        $user  =  Auth::user();
        if($user->role == 'A')
        $jwtToken  = $user->createToken('jwtToken',['admin'])->plainTextToken;
        else
        $jwtToken  = $user->createToken('jwtToken',['user'])->plainTextToken;

        $cookie = cookie('jwt',$jwtToken,60*24);
        return \response(['message'=>'Login successfully'],Response::HTTP_OK)->withCookie($cookie);
    }

    public function logout(){
        $cookie = Cookie::forget('jwt');
        return \response(['message'=>'Logout Successfully'],Response::HTTP_OK)->withCookie($cookie);
    }

}
