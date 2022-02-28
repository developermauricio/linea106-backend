<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    const ATTRIBUTES = ',key_server,id,correo,nombre,apellido,rol,clave,';

    private $attributes = ["key_server","id","correo"];

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

    private function getKey($data)
    {
        if (isset($data["key_server"]) && $data["key_server"] && trim($data["key_server"])) {
            return $data["key_server"];
        }
        $key = '';
        foreach ($this->attributes as $attribute) {
            if (isset($data[$attribute]) && $data[$attribute]) {
                $key .= '_' . $data[$attribute];
            } else {
                $key .= '_';
            }
        }
        return $key;
    }

    private function createUser($data)
    {
        try {
            $key = md5($this->getKey($data));
            $user = User::where('key', $key)->first();
            if (!$user) {
                DB::beginTransaction();
                $user = new User();
                $user->key_server = $data['key_server'];
                $user->key = $key;

                foreach ($data as $key => $value) {
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'id':
                            if (is_numeric($value)) {
                                $user->identificacion = $value;
                            }
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
