<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

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
        $content = json_decode(Route::dispatch($request)->getContent());
        return response()->json($content);
    }
}
