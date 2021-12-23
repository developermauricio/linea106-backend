<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    const ATTRIBUTES = ',id,genero,apellido,sexo,orientacion_sexual,municipio,edad,como_conocio,poblacion_interes,sisben,etnicidad,nombre,ocupacion,escolaridad,estado_civil,direccion,zona,fecha_nacimiento,tipo_id,otroDepartamento,vereda,';

    public function restore(Request $request)
    {
        $pacientes = collect($request->input('items'));

        $errores = [];
        $pacientes->each(function ($paciente) use (&$errores) {
            $error = $this->createPaciente($paciente);
            if ($error) {
                $errorData = new \stdClass();
                $errorData->msg = $error;
                $errorData->data = $paciente;
                $errores[] = $errorData;
            }
        });
        if (isset($errores[0])) {
            return response()->json($errores, 500);
        }
        return response()->json([], 201);
    }

    private function createPaciente($data)
    {
        die(json_encode($data));
        // try {
        //     $paciente = Paciente::where('key', $data['id'])->first();
        //     if (!$paciente) {
        //         DB::beginTransaction();
        //         $paciente = new paciente();

        //         foreach ($data as $key => $value) {
        //             if (!strpos(self::ATTRIBUTES, $key)) {
        //                 throw new \Exception('Nuevo atributo: ' . $key, 1);
        //             }
        //             switch ($key) {
        //                 case 'id':
        //                     $paciente->key = $value;
        //                     break;
        //                 case 'correo':
        //                     $paciente->email = $value;
        //                     break;
        //                 case 'nombre':
        //                     $paciente->name = $value;
        //                     break;
        //                 case 'apellido':
        //                     $paciente->last_name = $value;
        //                     break;
        //                 case 'rol':
        //                     $paciente->rol = $value;
        //                     break;
        //                 case 'clave':
        //                     $paciente->password = '$2y$10$MsrEtmbCg/gp8eDrBDCemuBVPlPG9ObuS7k4ZytepWy.hn2XpgD4.'; // 123;
        //                     break;
        //             }
        //         }
        //         $paciente->save();
        //         DB::commit();
        //     }
        //     return null;
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return $th->getMessage();
        // }
    }
}
