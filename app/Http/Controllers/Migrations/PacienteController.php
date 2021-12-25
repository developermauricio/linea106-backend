<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\EstadoCivil;
use App\Models\Etnia;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\NivelEducacion;
use App\Models\Ocupacion;
use App\Models\OrientacionSexual;
use App\Models\Paciente;
use App\Models\PoblacionInteres;
use App\Models\Sexo;
use App\Models\TipoIdentificacion;
use App\Models\Vereda;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            $key = md5(json_encode($data));
            $paciente = Paciente::where('key', $key)->first();
            if (!$paciente) {
                DB::beginTransaction();
                $paciente = new paciente();
                $paciente->key = $key;

                foreach ($data as $key => $value) {
                    if (!$value) {
                        continue;
                    }
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'id':
                            $paciente->identificacion = $this->getString($value);
                            break;
                        case 'genero':
                            $genero = $this->getGenero($value);
                            $paciente->genero_id = $genero->id;
                            break;
                        case 'apellido':
                            $paciente->apellido = $this->getString($value, true);
                            break;
                        case 'sexo':
                            $sexo = $this->getSexo($value);
                            $paciente->sexo_id = $sexo->id;
                            break;
                        case 'orientacion_sexual':
                            $orientacion_sexual = $this->getOrientacionSexual($value);
                            $paciente->orientacion_sexual_id = $orientacion_sexual->id;
                            break;
                        case 'edad':
                            $paciente->edad = intval($this->getString($value));
                            if ($paciente->edad > 255) {
                                $paciente->edad = null;
                            }
                            break;
                        case 'como_conocio':
                            $paciente->como_conocio = $this->getString($value);
                            break;
                        case 'poblacion_interes':
                            $poblacion_interes = $this->getPoblacionInteres($value);
                            $paciente->poblacion_interes_id = $poblacion_interes->id;
                            break;
                        case 'sisben':
                            $paciente->sisben = $this->getString($value);
                            break;
                        case 'etnicidad':
                            $etnia = $this->getEtnia($value);
                            $paciente->etnia_id = $etnia->id;
                            break;
                        case 'nombre':
                            $paciente->nombre = $this->getString($value, true);
                            break;
                        case 'ocupacion':
                            $ocupacion = $this->getOcupacion($value);
                            $paciente->ocupacion_id = $ocupacion->id;
                            break;
                        case 'escolaridad':
                            $nivel_educacion = $this->getNivelEducacion($value);
                            $paciente->nivel_educacion_id = $nivel_educacion->id;
                            break;
                        case 'estado_civil':
                            $estado_civil = $this->getEstadoCivil($value);
                            $paciente->estado_civil_id = $estado_civil->id;
                            break;
                        case 'direccion':
                            $paciente->direccion = trim($value);
                            break;
                        case 'zona':
                            $zona = $this->getZona($value);
                            $paciente->zona_id = $zona->id;
                            break;
                        case 'fecha_nacimiento':
                            $paciente->fecha_nacimiento = \Carbon\Carbon::parse($value)->toDateString();
                            break;
                        case 'tipo_id':
                            $tipo_identificacion = $this->getTipoIdentificacion($value);
                            $paciente->tipo_identificacion_id = $tipo_identificacion->id;
                            break;
                    }
                }

                $this->setLocation($paciente, $data);
                $paciente->save();
                DB::commit();
            }
            return null;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    private function setLocation(&$paciente, $data)
    {
        $departamento = null;
        $municipio = null;
        $vereda = null;

        $errores = '';

        try {
            if (isset($data['otroDepartamento'])) {
                $departamento = $this->getDepartamento($data['otroDepartamento']);
            }
        } catch (\Throwable $th) {
            $errores .= "\n" . $th->getMessage() . "\n";
        }

        try {
            if (isset($data['municipio'])) {
                $municipio = $this->getMunicipio($data['municipio'], $departamento);
                if (!$departamento) {
                    $departamento = Departamento::find($municipio->departamento_id);
                }
            }
        } catch (\Throwable $th) {
            $errores .= "\n" . $th->getMessage() . "\n";
        }

        try {
            if (isset($data['vereda'])) {
                $vereda = $this->getVereda($data['vereda'], $municipio);
                if (!$municipio) {
                    $municipio = Municipio::find($vereda->municipio_id);
                }
            }
        } catch (\Throwable $th) {
            $errores .= "\n" . $th->getMessage() . "\n";
        }

        if ($departamento) {
            $paciente->departamento_id = $departamento->id;
        }

        if ($municipio) {
            $paciente->municipio_id = $municipio->id;
            $paciente->departamento_id = $municipio->departamento_id;
        }

        if ($vereda) {
            $paciente->vereda_id = $vereda->id;
        }

        $paciente->errores .= $errores;
    }


    private function getTipoIdentificacion($name)
    {
        $name = $this->getString($name, true);
        $tipo_identificacion = TipoIdentificacion::where('name', 'like', '%' . $name . '%')->first();

        if (!$tipo_identificacion) {
            $tipo_identificacion = new TipoIdentificacion();
            $tipo_identificacion->name = $name;
            $tipo_identificacion->save();
        }
        return $tipo_identificacion;
    }

    private function getZona($name)
    {
        $name = $this->getString($name, true);
        $zona = Zona::where('name', 'like', '%' . $name . '%')->first();

        if (!$zona) {
            $zona = new Zona();
            $zona->name = $name;
            $zona->save();
        }
        return $zona;
    }

    private function getEstadoCivil($name)
    {
        $name = $this->getString($name, true);
        $estado_civil = EstadoCivil::where('name', 'like', '%' . $name . '%')->first();

        if (!$estado_civil) {
            $estado_civil = new EstadoCivil();
            $estado_civil->name = $name;
            $estado_civil->save();
        }
        return $estado_civil;
    }

    private function getNivelEducacion($name)
    {
        $name = $this->getString($name, true);
        $nivel_educacion = NivelEducacion::where('name', 'like', '%' . $name . '%')->first();

        if (!$nivel_educacion) {
            $nivel_educacion = new NivelEducacion();
            $nivel_educacion->name = $name;
            $nivel_educacion->save();
        }
        return $nivel_educacion;
    }

    private function getOcupacion($name)
    {
        $name = $this->getString($name, true);
        $ocupacion = Ocupacion::where('name', 'like', '%' . $name . '%')->first();

        if (!$ocupacion) {
            $ocupacion = new Ocupacion();
            $ocupacion->name = $name;
            $ocupacion->save();
        }
        return $ocupacion;
    }

    private function getEtnia($name)
    {
        $name = $this->getString($name, true);
        $etnia = Etnia::where('name', 'like', '%' . $name . '%')->first();

        if (!$etnia) {
            $etnia = new Etnia();
            $etnia->name = $name;
            $etnia->save();
        }
        return $etnia;
    }

    private function getPoblacionInteres($name)
    {
        $name = $this->getString($name, true);
        $poblacion_interes = PoblacionInteres::where('name', 'like', '%' . $name . '%')->first();

        if (!$poblacion_interes) {
            $poblacion_interes = new PoblacionInteres();
            $poblacion_interes->name = $name;
            $poblacion_interes->save();
        }
        return $poblacion_interes;
    }

    private function getMunicipio($name, $departamento)
    {
        $name = $this->getString($name, true);

        if ($name === "Otro Departamento") {
            return null;
        }

        $municipio = Municipio::where('name', 'like', '%' . $name . '%');

        if ($departamento) {
            $municipio->where('departamento_id', $departamento->id);
        }
        $municipio = $municipio->first();

        if (!$municipio) {
            throw new \Exception("Municipio no valido (" . $name . "):" . ($departamento ? $departamento->name : ''), 1);
        }
        return $municipio;
    }

    private function getDepartamento($name)
    {
        $name = $this->getString($name, true);
        $departamento = Departamento::where('name', 'like', '%' . $name . '%')->first();
        if (!$departamento) {
            throw new \Exception("departamento no valido (" . $name . ")", 1);
        }
        return $departamento;
    }

    private function getVereda($name, $municipio)
    {
        $name = $this->getString(str_replace('Vereda', '', $name), true);
        $vereda = Vereda::where('name', 'like', '%' . $name . '%');
        if ($municipio) {
            $vereda->where('municipio_id', $municipio->id);
        }
        $vereda = $vereda->first();
        if (!$vereda) {
            throw new \Exception("vereda no valido (" . $name . "):" . ($municipio ? $municipio->name : ''), 1);
        }
        return $vereda;
    }

    private function getOrientacionSexual($name)
    {
        $name = $this->getString($name, true);
        $orientacion_sexual = OrientacionSexual::where('name', 'like', '%' . $name . '%')->first();

        if (!$orientacion_sexual) {
            $orientacion_sexual = new OrientacionSexual();
            $orientacion_sexual->name = $name;
            $orientacion_sexual->save();
        }
        return $orientacion_sexual;
    }

    private function getSexo($name)
    {
        $name = $this->getString($name, true);
        $sexo = Sexo::where('name', 'like', '%' . $name . '%')->first();

        if (!$sexo) {
            $sexo = new Sexo();
            $sexo->name = $name;
            $sexo->save();
        }
        return $sexo;
    }

    private function getGenero($name)
    {
        $name = $this->getString($name, true);
        $genero = Genero::where('name', 'like', '%' . $name . '%')->first();

        if (!$genero) {
            $genero = new Genero();
            $genero->name = $name;
            $genero->save();
        }
        return $genero;
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
