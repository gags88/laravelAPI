<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

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
            //'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        try{
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        }catch (JWTException $e){
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
        // all good so return the token
        return response()->json([
            'token' => $token
        ], 200);
    }

}