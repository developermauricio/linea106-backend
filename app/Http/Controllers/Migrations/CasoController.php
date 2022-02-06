<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use App\Models\Etnicidad;
use App\Models\LineaIntervencion;
use App\Models\MotivoConsulta;
use App\Models\MotivoConsultaEspecifico;
use App\Models\Origen;
use App\Models\Paciente;
use App\Models\QuienComunica;
use App\Models\Radicado;
use App\Models\Relacion;
use App\Models\Remision;
use App\Models\Respuesta;
use App\Models\TipoPaciente;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasoController extends Controller
{

    const ATTRIBUTES = ',key_server,observaciones,narrativa,fuente,ultima_actualizacion,paciente,motivoConsulta,quien_comunica,linea_intervencion,psicologo,fecha_inicio,origen,tipo_paciente,fecha_fin,cual_motivo,turno,nombre_llama,documento_llama,relacion,remision,respuesta,radicado,etnicidad,especificoViolencia,especificoSuicidio,especificoSaludMental,especificoEstadosEmocionales,especificoVulnerabilidad,especificoContexto,especificoSalud,especificoTrastornos,especificoCoronavirus,especificoFamiliar,especificoSustancias,especificoProtocolos,especificoSaludSexual,especificoLaboral,especificoEducacion,numberOfDocs,';

    public function restore(Request $request)
    {
        $casos = collect($request->input('items'));

        $errores = [];
        $casos->each(function ($caso) use (&$errores) {
            $error = $this->createCaso($caso);
            if ($error) {
                $errorData = new \stdClass();
                $errorData->msg = $error;
                $errorData->data = $caso;
                $errores[] = $errorData;
            }
        });
        if (isset($errores[0])) {
            return response()->json($errores, 500);
        }
        return response()->json([], 201);
    }

    private function createCaso($data)
    {
        try {
            $caso = Caso::where('key_server', $data['key_server'])->first();
            if (!$caso) {
                DB::beginTransaction();
                if (!isset($data['observaciones']) || !$data['observaciones']) {
                    return null;
                }

                $caso = new Caso();
                $caso->key_server = $data['key_server'];
                $caso->key = md5(json_encode($data));
                $caso->errores = '';

                if (isset($data['motivoConsulta'])) {
                    $motivoConsulta = $data['motivoConsulta'];
                    $caso->motivo_consulta_id = $this->getMotivoConsulta($motivoConsulta)->id;
                }

                foreach ($data as $key => $value) {
                    if (!$value) {
                        continue;
                    }
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'observaciones':
                            $caso->observaciones = $this->getString($value);
                            break;
                        case 'narrativa':
                            $caso->narrativa = $this->getString($value);
                            break;
                        case 'fuente':
                            $caso->fuente = $this->getString($value);
                            if (strlen($caso->fuente) > 200) {
                                $caso->errores .= "\nFuente invalida: " . $value . "\n";
                                $caso->fuente = 'N/A';
                            }
                            break;
                        case 'ultima_actualizacion':
                            try {
                                $caso->updated_at = $this->getDate($value);
                            } catch (\Throwable $th) {
                                $caso->updated_at = null;
                                $caso->errores .= "\n ultima actualización " . $th->getMessage() . "\n";
                            }
                            break;
                        case 'paciente':
                            try {
                                $caso->paciente_id = $this->getPaciente($value)->id;
                            } catch (\Throwable $th) {
                                $caso->paciente_id = null;
                                $caso->errores .= "\n" . $th->getMessage() . "\n";
                            }
                            break;
                        case 'quien_comunica':
                            $caso->quien_comunica_id = $this->getQuienComunica($value)->id;
                            break;
                        case 'linea_intervencion':
                            $caso->linea_intervencion_id = $this->getLineaIntervencion($value)->id;
                            break;
                        case 'psicologo':
                            $caso->usuario_id = $this->getUsuario($value)->id;
                            break;
                        case 'fecha_inicio':
                            try {
                                $caso->fecha_inicio = $this->getDate($value);
                                $caso->created_at = $caso->fecha_inicio;
                            } catch (\Throwable $th) {
                                $caso->fecha_inicio = null;
                                $caso->created_at = null;
                                $caso->errores .= "\n fecha inicio " . $th->getMessage() . "\n";
                            }
                            break;
                        case 'origen':
                            $caso->origen_id = $this->getOrigen($value)->id;
                            break;
                        case 'tipo_paciente':
                            $caso->tipo_paciente_id = $this->getTipoPaciente($value)->id;
                            break;
                        case 'fecha_fin':
                            try {
                                $caso->fecha_fin = $this->getDate($value);
                            } catch (\Throwable $th) {
                                $caso->fecha_fin = null;
                                $caso->errores .= "\n fecha fin " . $th->getMessage() . "\n";
                            }
                            break;
                        case 'turno':
                            $caso->turno_id = $this->getTurno($value)->id;
                            break;
                        case 'nombre_llama':
                            $caso->nombre_llama = $this->getString($value);
                            break;
                        case 'documento_llama':
                            $caso->documento_llama = $this->getString($value);
                            break;
                        case 'relacion':
                            $caso->nombre_llama = $this->getRelacion($value)->id;
                            break;
                        case 'remision':
                            $caso->remision_id = $this->getRemision($value)->id;
                            break;
                        case 'respuesta':
                            $caso->respuesta_id = $this->getRespuesta($value)->id;
                            break;
                        case 'radicado':
                            $caso->radicado_id = $this->getRadicado($value)->id;
                            break;
                        case 'etnicidad':
                            $caso->etnicidad_id = $this->getEtnicidad($value)->id;
                            break;
                        case 'cual_motivo':
                            $caso->descripcion_motivo = $value;
                        case 'especificoViolencia':
                        case 'especificoSuicidio':
                        case 'especificoSaludMental':
                        case 'especificoEstadosEmocionales':
                        case 'especificoVulnerabilidad':
                        case 'especificoContexto':
                        case 'especificoSalud':
                        case 'especificoTrastornos':
                        case 'especificoCoronavirus':
                        case 'especificoFamiliar':
                        case 'especificoSustancias':
                        case 'especificoProtocolos':
                        case 'especificoSaludSexual':
                        case 'especificoLaboral':
                        case 'especificoEducacion':
                            $motivo_consulta_especifico = $this->getMotivoConsultaEspecifico($value, $caso);
                            $caso->motivo_consulta_especifico_id = $motivo_consulta_especifico->id;
                            break;
                        case 'numberOfDocs':
                            break;
                    }
                }

                if ($caso->created_at) {
                    if ($caso->updated_at) {
                        $caso->created_at = $caso->updated_at;
                    } else if ($caso->fecha_fin) {
                        $caso->updated_at = $caso->fecha_fin;
                    }
                }
                $caso->save();
                DB::commit();
            }
            return null;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
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

        $usuario = new User();
        $usuario->name = $original;
        $usuario->last_name = $original;
        $usuario->email = $original;
        $usuario->password = "N/A";
        $usuario->rol = User::PSICOLOGO;
        $usuario->save();
        return $usuario;
    }

    private function getMotivoConsultaEspecifico($value, $caso)
    {
        $value = $this->getString($value, true);
        $motivo_consulta_especifico = MotivoConsultaEspecifico::where('name', '=', $value)->first();
        if (!$motivo_consulta_especifico) {
            $motivo_consulta_especifico = new MotivoConsultaEspecifico();
            $motivo_consulta_especifico->name = $value;
            $motivo_consulta_especifico->motivo_consulta_id = $caso->motivo_consulta_id;
            $motivo_consulta_especifico->save();
        }
        return $motivo_consulta_especifico;
    }

    private function getEtnicidad($value)
    {
        $value = $this->getString($value, true);
        $etnicidad = Etnicidad::where('name', '=', $value)->first();
        if (!$etnicidad) {
            $etnicidad = new Etnicidad();
            $etnicidad->name = $value;
            $etnicidad->save();
        }
        return $etnicidad;
    }

    private function getRemision($value)
    {
        $value = $this->getString($value, true);
        $remision = Remision::where('name', '=', $value)->first();
        if (!$remision) {
            $remision = new Remision();
            $remision->name = $value;
            $remision->save();
        }
        return $remision;
    }

    private function getRelacion($value)
    {
        $value = $this->getString($value, true);
        $relacion = Relacion::where('name', '=', $value)->first();
        if (!$relacion) {
            $relacion = new Relacion();
            $relacion->name = $value;
            $relacion->save();
        }
        return $relacion;
    }

    private function getTurno($value)
    {
        $value = $this->getString($value, true);
        $turno = Turno::where('name', '=', $value)->first();
        if (!$turno) {
            $turno = new Turno();
            $turno->name = $value;
            $turno->save();
        }
        return $turno;
    }


    private function getRespuesta($value)
    {
        $value = $this->getString($value, true);
        $respuesta = Respuesta::where('name', '=', $value)->first();
        if (!$respuesta) {
            $respuesta = new Respuesta();
            $respuesta->name = $value;
            $respuesta->save();
        }
        return $respuesta;
    }

    private function getRadicado($value)
    {
        $value = $this->getString($value, true);
        $radicado = Radicado::where('name', '=', $value)->first();
        if (!$radicado) {
            $radicado = new Radicado();
            $radicado->name = $value;
            $radicado->save();
        }
        return $radicado;
    }

    private function getTipoPaciente($value)
    {
        $value = $this->getString($value, true);
        $tipo_paciente = TipoPaciente::where('name', '=', $value)->first();
        if (!$tipo_paciente) {
            $tipo_paciente = new TipoPaciente();
            $tipo_paciente->name = $value;
            $tipo_paciente->save();
        }
        return $tipo_paciente;
    }


    private function getOrigen($value)
    {
        $value = $this->getString($value, true);
        $origen = Origen::where('name', '=', $value)->first();
        if (!$origen) {
            $origen = new Origen();
            $origen->name = $value;
            $origen->save();
        }
        return $origen;
    }

    private function getLineaIntervencion($value)
    {
        $value = $this->getString($value, true);
        $linea_intervencion = LineaIntervencion::where('name', '=', $value)->first();
        if (!$linea_intervencion) {
            $linea_intervencion = new LineaIntervencion();
            $linea_intervencion->name = $value;
            $linea_intervencion->save();
        }
        return $linea_intervencion;
    }

    private function getQuienComunica($value)
    {
        $value = $this->getString($value, true);
        $quien_comunica = QuienComunica::where('name', '=', $value)->first();
        if (!$quien_comunica) {
            $quien_comunica = new QuienComunica();
            $quien_comunica->name = $value;
            $quien_comunica->save();
        }
        return $quien_comunica;
    }

    private function getMotivoConsulta($value)
    {
        $value = $this->getString($value, true);
        $motivoConsulta = MotivoConsulta::where('name', '=', $value)->first();
        if (!$motivoConsulta) {
            $motivoConsulta = new MotivoConsulta();
            $motivoConsulta->name = $value;
            $motivoConsulta->save();
        }
        return $motivoConsulta;
    }

    private function getPaciente($value)
    {

        $valueLike = "%" . preg_replace('/( )+/', "%", $this->getString($value)) . "%";

        $paciente = Paciente::where('key_server', $value)->orWhere('identificacion', $value)->first();

        if (!$paciente) {
            $paciente = Paciente::whereRaw('concat(nombre, " ", apellido) like ? or key_server like ? or identificacion like ?', [$valueLike, $valueLike, $valueLike])->first();
        }

        if ($paciente) {
            return $paciente;
        }
        throw new \Exception("No se encontró el paciente " . $value, 1);
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
