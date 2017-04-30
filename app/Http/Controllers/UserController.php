<?php

namespace App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller{
    public function signup(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $user->save();
        return response()->json([
            'message' => 'User successfully Created'
        ],201);
    }

    public function signin(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try{
            if()
        }catch (JWTException $e){

        }
    }

}