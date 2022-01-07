<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getAdministradores()
    {
        $administradores = User::where('rol', User::ADMINISTRADOR)->get();
        return response()->json($administradores);
    }

    public function getPsicologos()
    {
        $psicologos = User::where('rol', User::PSICOLOGO)->get();
        return response()->json($psicologos);
    }

    public function index()
    {
        return response()->json([], 501);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('nombre');
        $user->last_name = $request->input('apellido');
        $user->password = Hash::make($request->input('clave'));
        $user->email = $request->input('correo');
        $user->identificacion = $request->input('id');
        $user->rol = $request->input('rol');
        $user->estado = User::ACTIVO;
        $user->save();

        return response()->json($user, 201);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('nombre');
        $user->last_name = $request->input('apellido');
        $user->rol = $request->input('rol');
        $user->save();

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Throwable $th) {
            $user->estado = 0;
            $user->save();
        }
        return response()->json([], 204);
    }

    public function toggleStatus($id)
    {
        $user = User::select('id', 'estado')->findOrFail($id);
        $user->estado = !$user->estado;
        $user->save();
        return response()->json($user);
    }
}
