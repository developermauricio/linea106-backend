<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use App\Models\Seguimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    const ATTRIBUTES = ',key_server,id_caso,psicologo,fecha,seguimiento,';

    public function restore(Request $request)
    {
        $seguimientos = collect($request->input('items'));

        $errores = [];
        $seguimientos->each(function ($seguimiento) use (&$errores) {
            $error = $this->createSeguimiento($seguimiento);
            if ($error) {
                $errorData = new \stdClass();
                $errorData->msg = $error;
                $errorData->data = $seguimiento;
                $errores[] = $errorData;
            }
        });
        if (isset($errores[0])) {
            return response()->json($errores, 500);
        }
        return response()->json([], 201);
    }

    private function createSeguimiento($data)
    {
        try {
            $seguimiento = Seguimiento::where('key_server', $data['key_server'])->first();
            if (!$seguimiento) {
                DB::beginTransaction();
                $seguimiento = new Seguimiento();
                $seguimiento->key_server = $data['key_server'];
                $seguimiento->key = md5(json_encode($data));

                foreach ($data as $key => $value) {
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'id_caso':
                            $seguimiento->caso_id = $this->getCaso($value)->id;
                            break;
                        case 'psicologo':
                            $seguimiento->usuario_id = $this->getUsuario($value)->id;
                            break;
                        case 'fecha':
                            $seguimiento->created_at = $this->getDate($value);
                            break;
                        case 'seguimiento':
                            $seguimiento->seguimiento = $this->getString($value);
                            break;
                    }
                }
                $seguimiento->save();
                DB::commit();
            }
            return null;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    private function getCaso($value)
    {
        $caso = Caso::where('fuente', $value)->orWhere('key_server', $value)->first();
        $original = $this->getString($value);
        $value = "%" . preg_replace('/( )+/', "%", $original) . "%";
        if (!$caso) {
            $caso = Caso::where('fuente', 'like', $value)->orWhere('key_server', 'like', $value)->first();
        }
        if ($caso) {
            return $caso;
        }
        throw new \Exception("Caso no encontrado", 1);
    }

    private function getUsuario($value)
    {
        $usuario = User::where('email', $value)->orWhere('key_server', $value)->first();

        $original = $this->getString($value);
        $value = "%" . preg_replace('/( )+/', "%", $original) . "%";

        if (!$usuario) {
            $usuario = User::whereRaw("concat(name, ' ', last_name) like ? or email like ? or key_server like ?", ["%$value%", "%$value%", "%$value%"])->first();
        }

        if ($usuario) {
            return $usuario;
        }

        throw new \Exception("Usuario no encontrado " . $original, 1);


        // $usuario = new User();
        // $usuario->name = $original;
        // $usuario->last_name = $original;
        // $usuario->email = $original;
        // $usuario->password = "N/A";
        // $usuario->rol = User::PSICOLOGO;
        // $usuario->save();
        // return $usuario;
    }

    private function getDate($string)
    {
        if (is_numeric($string)) {
            if (intval($string) < 0) {
                throw new \Exception("Fecha invalida " . $string, 1);
            }
            return \Carbon\Carbon::createFromTimestampMs($string);
        }
        return \Carbon\Carbon::parse($string);
    }

    private function getString($string, $camelcase = false)
    {
        $string = trim($string);
        if (!$camelcase) {
            return $string;
        }
        $final = '';
        $segments = explode(' ', $string);
        foreach ($segments as $segment) {
            if ($final !== '' && $segment) {
                $final .= ' ';
            }
            $final .= $this->formatStringUpper($segment);
        }
        return $final;
    }

    private function formatStringUpper($palabra)
    {
        if (!$palabra) {
            return '';
        }
        $palabra = strtolower($palabra);
        $palabra[0] = strtoupper($palabra)[0];
        return $palabra;
    }
}
