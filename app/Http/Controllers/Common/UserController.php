<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function updateProfile(UpdateProfileRequest $updateProfile)
    {
        $user = User::find(auth('api')->user()->id);
        $user->password = Hash::make($updateProfile->input('password'));
        $user->save();

        return response()->json($updateProfile->all());
    }
}
