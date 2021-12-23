<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    const ATTRIBUTES = ',id,correo,nombre,apellido,rol,clave,';

    public function restore(Request $request)
    {
        $users = collect($request->input('items'));

        $errores = [];
        $users->each(function ($user) use (&$errores) {
            $error = $this->createUser($user);
            if ($error) {
                $errorData = new \stdClass();
                $errorData->msg = $error;
                $errorData->data = $user;
                $errores[] = $errorData;
            }
        });
        if (isset($errores[0])) {
            return response()->json($errores, 500);
        }
        return response()->json([], 201);
    }

    private function createUser($data)
    {
        try {
            $user = User::where('key', $data['id'])->first();
            if (!$user) {
                DB::beginTransaction();
                $user = new User();

                foreach ($data as $key => $value) {
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'id':
                            $user->key = $value;
                            break;
                        case 'correo':
                            $user->email = $value;
                            break;
                        case 'nombre':
                            $user->name = $value;
                            break;
                        case 'apellido':
                            $user->last_name = $value;
                            break;
                        case 'rol':
                            $user->rol = $value;
                            break;
                        case 'clave':
                            $user->password = '$2y$10$MsrEtmbCg/gp8eDrBDCemuBVPlPG9ObuS7k4ZytepWy.hn2XpgD4.'; // 123;
                            break;
                    }
                }
                $user->save();
                DB::commit();
            }
            return null;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
}
