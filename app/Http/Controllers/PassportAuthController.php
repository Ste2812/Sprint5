<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PassportAuthController extends Controller
{
    public function login(Request $request){

        $loginData= $request->validate([
            'name'=> 'required',
            'email'=> 'email|required',
            'password'=> 'required',
        ]);

        if (!auth()->attempt($loginData)){
            return response(['massage'=> 'Credenciales invalidas'], 401);

        }


        //$accessToken = auth()->user()->createToken('authToken')->accessToken;
        //$user= User::where('name', $request->name)->first();
        $user= $request->auth()->user();

        $accessToken= $user->createToken('authToken')->accessToken;



        return response(['access_token'=>$accessToken]);

    }

    public function register(Request $request){

        $validateData= $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'

        ]);

        $validateData['password'] = Hash::make($request->password);

        $user= User::create($validateData);
        $user->assignRole('user');

        response([
            'name' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            ['message' => 'Successfully logged out'], 200
        ]);
    }

}
