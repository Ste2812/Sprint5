<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){

        $validateData= $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'

        ]);

        $validateData['password'] = Hash::make($request->password);


        $user = User::create($validateData);

        //$user= User::where('email', $request->email)->first();

        //$accessToken= $user->createToken('userToken')->accessToken;

       // $accessToken =$user->createToken('authToken')->accessToken;

        return response([
            'name' => $user,
            //'access_token' => $accessToken
        ]);


    }

    public function login(Request $request){


        $loginData= $request->validate([
            'email'=> 'email|required',
            'password'=> 'required',
        ]);

        if (!auth()->attempt($loginData)){
            return response(['massage'=> 'Credenciales invalidas'], 401);

        }
        //$user= User::where('email', $request->email)->first();

        $accessToken= Auth::user()->createToken('authToken')->accessToken;



        return response(['access_token'=>$accessToken]);

    }

    public function authenticatedUserDetails(){

        return response()->json(['user'=> Auth::user()]);
    }

    public function logout(Request $request){
        $token=$request->user()->token();
        $token->revoke();
        $response= ['message'=> 'Logout con exito'];

        return response($response, 200);
    }


}
