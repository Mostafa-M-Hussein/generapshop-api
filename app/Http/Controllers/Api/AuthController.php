<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApiResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'email' => 'required',
        ]);

        $credintails  = $request->only('password' , 'email') ;



        if (Auth::attempt( $credintails )) {

            $user = User::where('email'  ,  $credintails['email'] )->first();

            return new UserApiResource($user);

        }

        return
            [
                'message' => 'User login attempt Faild',
                'error' => true,

            ] ;

    }

    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required',

        ]);
        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
        $user->save();
        return new UserApiResource($user);



    }





}