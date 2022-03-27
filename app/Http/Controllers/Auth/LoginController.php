<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {

        if(Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password,
        ])){
            $user = Auth::user();
            $token = $user->createToken('API')->accessToken;
            return response()->json(
                [
                    'message' => 'User Login Successful',
                    'token'=>[
                        'token_type'=>'Bearer',
                        'experies_at'=>Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString(),
                        'token'=>$token,
                    ],
                    'success'=> true
                ]);
        }
        else{
            return response()->json(
                [
                    'message'=>'Unauthorised',
                    'success'=>false
                ], 401);
        }
    }
}
