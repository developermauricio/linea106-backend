<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Laravel\Passport\Token;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $client = Client::where('revoked', 0)->where('password_client', 1)->first();

        $request = FacadesRequest::create(
            route('passport.token'),
            'POST',
            [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'scope' => '*',
            ]
        );

        FacadesRequest::replace($request->input());
        return Route::dispatch($request);
    }

    public function userAuth(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user('api')->token()->revoke();
        // Token::whereIn('id', $tokens)
        //     ->update(['revoked', true]);
        return response()->json([]);
    }
}
