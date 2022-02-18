<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use App\Models\ComoConocio;
use App\Models\Departamento;
use App\Models\EstadoCivil;
use App\Models\Etnia;
use App\Models\Etnicidad;
use App\Models\Genero;
use App\Models\LineaIntervencion;
use App\Models\MotivoConsulta;
use App\Models\MotivoConsultaEspecifico;
use App\Models\NivelEducacion;
use App\Models\Ocupacion;
use App\Models\OrientacionSexual;
use App\Models\Origen;
use App\Models\Paciente;
use App\Models\PoblacionInteres;
use App\Models\QuienComunica;
use App\Models\Radicado;
use App\Models\Relacion;
use App\Models\Remision;
use App\Models\Respuesta;
use App\Models\Sexo;
use App\Models\TipoIdentificacion;
use App\Models\TipoPaciente;
use App\Models\Turno;
use App\Models\User;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasoController extends Controller
{

    public function getAll(Request $request)
    {
        $fuente = $request->input('fuente');
        $origen = $request->input('origen');
        $motivo_consulta = $request->input('motivo_consulta');
        $usuario = $request->input('usuario');
        $paciente = $request->input('paciente');
        $linea_intervencion = $request->input('linea_intervencion');
        $mis_casos = $request->input('mis_casos', false);
        $fecha_inicio = $request->input('fecha_inicio');

        $casos = Caso::with([
            'paciente',
            'usuario',
            'origen',
            'motivo_consulta',
            'linea_intervencion',
            'respuesta'
        ])->orderBy('fecha_inicio', 'DESC');

        if ($fuente) {
            $casos->where('fuente', 'like', "%{$fuente}%");
        }

        if ($origen) {
            $casos->whereHas('origen', function ($q_origen) use ($origen) {
                return $q_origen->where('name', 'like', "%{$origen}%");
            });
        }

        if ($paciente) {
            $casos->whereHas('paciente', function ($q_paciente) use ($paciente) {
                return $q_paciente->whereRaw('concat(nombre, " ", apellido) like ?', ["%{$paciente}%"]);
            });
        }

        if (!$mis_casos && $usuario) {
            $casos->whereHas('usuario', function ($q_usuario) use ($usuario) {
                return $q_usuario->whereRaw('concat(name, " ", last_name) like ?', ["%{$usuario}%"]);
            });
        } else if ($mis_casos) {
            $casos->where('usuario_id', auth('api')->user()->id);
        }

        if ($motivo_consulta) {
            $casos->whereHas('motivo_consulta', function ($q_motivo_consulta)  use ($motivo_consulta) {
                return $q_motivo_consulta->where('name', 'like', "%{$motivo_consulta}%");
            });
        }

        if ($linea_intervencion) {
            $casos->whereHas('linea_intervencion', function ($q_linea_intervencion) use ($linea_intervencion) {
                return $q_linea_intervencion->where('name', 'like', "%{$linea_intervencion}%");
            });
        }

        $casos->orderBy('updated_at');

        return response()->json($casos->paginate(10));
    }

    public function show($id)
    {
        $caso = Caso::with([
            'paciente',
            'motivo_consulta',
            'motivo_consulta_especifico',
            'quien_comunica',
            'linea_intervencion',
            'usuario',
            'tipo_paciente',
            'origen',
            'turno',
            'etnicidad',
            'relacion',
            'remision',
            'respuesta',
            'radicado',
        ])->find($id);
        return response()->json($caso);
    }

    public function initDataCase()
    {
        $motivosConsultas = MotivoConsulta::select('id', 'name')->orderBy('name')->get();
        $motivosConsultaEspecificos = MotivoConsultaEspecifico::select('id', 'name', 'motivo_consulta_id')->orderBy('name')->get();
        $quienComunica = QuienComunica::all('id', 'name');
        $lineaIntervenciones = LineaIntervencion::all('id', 'name');
        $tipoPacientes = TipoPaciente::all('id', 'name');
        $origenes = Origen::all('id', 'name');
        $turnos = Turno::all('id', 'name');
        $etnicidades = Etnicidad::all('id', 'name');
        $relaciones = Relacion::all('id', 'name');
        $remisiones = Remision::all('id', 'name');
        $respuestas = Respuesta::all('id', 'name');
        $radicados = Radicado::all('id', 'name');

        return response()->json([
            'motivosConsultas' => $motivosConsultas,
            'motivosConsultaEspecificos' => $motivosConsultaEspecificos,
            'quienComunica' => $quienComunica,
            'lineaIntervenciones' => $lineaIntervenciones,
            'tipoPacientes' => $tipoPacientes,
            'origenes' => $origenes,
            'turnos' => $turnos,
            'etnicidades' => $etnicidades,
            'relaciones' => $relaciones,
            'remisiones' => $remisiones,
            'respuestas' => $respuestas,
            'radicados' => $radicados,
        ]);
    }

    public function initDataPaciente()
    {
        $orientaciones_sexuales = OrientacionSexual::all('id', 'name');
        $generos = Genero::all('id', 'name');
        $sexos = Sexo::all('id', 'name');
        $etnias = Etnia::all('id', 'name');
        $estado_civiles = EstadoCivil::all('id', 'name');
        $ocupaciones = Ocupacion::all('id', 'name');
        $niveles_educacion = NivelEducacion::all('id', 'name');
        $zonas = Zona::all('id', 'name');
        $tipos_identificacion = TipoIdentificacion::all('id', 'name');
        $departamentos = Departamento::all('id', 'name');
        $como_conocio = ComoConocio::all('id', 'name');
        $poblacion_intereses = PoblacionInteres::all('id', 'name');

        return response()->json([
            'orientaciones_sexuales' => $orientaciones_sexuales,
            'generos' => $generos,
            'sexos' => $sexos,
            'etnias' => $etnias,
            'estado_civiles' => $estado_civiles,
            'ocupaciones' => $ocupaciones,
            'niveles_educacion' => $niveles_educacion,
            'zonas' => $zonas,
            'tipos_identificacion' => $tipos_identificacion,
            'departamentos' => $departamentos,
            'como_conocio' => $como_conocio,
            'poblacion_intereses' => $poblacion_intereses,
        ]);
    }

    public function motivoEspecificoById($id)
    {
        $motivosConsultasEspecificos = MotivoConsultaEspecifico::select('id', 'name')->where('motivo_consulta_id', $id)->get();
        return response()->json($motivosConsultasEspecificos);
    }

    public function searchPaciente(Request $request)
    {
        $query = '%' . $request->input('q', '') . '%';

        $query = preg_replace("/( )+/", '%', $query);

        $pacientes = Paciente::select('id', 'nombre', 'apellido', 'identificacion')
            ->orWhere(DB::raw("CONCAT(`nombre`, ' ', `apellido`)"), 'LIKE', $query)
            ->orWhere('identificacion', 'like', $query)
            ->limit(5)->get();

        return response()->json($pacientes);
    }

    public function pacienteById($id)
    {
        $paciente = Paciente::with(
            'orientacion_sexual',
            'genero',
            'sexo',
            'etnia',
            'estado_civil',
            'ocupacion',
            'nivel_educacion',
            'zona',
            'tipo_identificacion',
            'poblacion_interes',
            'municipio',
            'departamento',
            'vereda',
            'como_conocio'
        )->where('id', $id)->first();

        return response()->json($paciente);
    }


    public function gestionCaso(Request $request)
    {
        $caso = $request->input('caso');
        $paciente = $request->input('paciente');
        DB::beginTransaction();

        $tipoPaciente = null;
        try {
            $paciente = $this->storeOrUpdatePaciente($caso, $paciente, $tipoPaciente);
            $caso = $this->storeOrUpdateCase($caso, $paciente, $tipoPaciente);
            DB::commit();
            return response()->json([
                'caso' => $caso,
                'paciente' => $paciente
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'msg' => $th->getMessage(),
                'trace' => $th->getTrace()
            ], 501);
        }
    }

    private function storeOrUpdateCase($casoData, $paciente, $tipoPaciente)
    {
        try {
            $caso = null;
            if (isset($casoData['id'])) {
                $caso = Caso::find($casoData['id']);
            }
            if (!$caso) {
                $caso = new Caso();
                $caso->tipo_paciente_id = $tipoPaciente;
                $caso->usuario_id = auth('api')->user()->id;
            }
            $caso->observaciones = $casoData['observaciones'];
            $caso->narrativa = $casoData['narrativa'];
            $caso->fuente = $casoData['fuente'];
            $caso->fecha_inicio = $casoData['fecha_inicio'];
            $caso->fecha_fin = $casoData['fecha_fin'];
            $caso->nombre_llama = $casoData['nombre_llama'];
            $caso->documento_llama = $casoData['documento_llama'];
            $caso->descripcion_motivo = $casoData['descripcion_motivo'];
            $caso->descripcion_relacion = $casoData['descripcion_relacion'];
            $caso->descripcion_radicado = $casoData['descripcion_radicado'];
            $caso->paciente_id = $paciente->id;
            if (isset($casoData['motivo_consulta'])) {
                $caso->motivo_consulta_id = $casoData['motivo_consulta']['id'];
            }
            if (isset($casoData['motivo_consulta_especifico'])) {
                $caso->motivo_consulta_especifico_id = $casoData['motivo_consulta_especifico']['id'];
            }
            if (isset($casoData['quien_comunica'])) {
                $caso->quien_comunica_id = $casoData['quien_comunica']['id'];
            }
            if (isset($casoData['linea_intervencion'])) {
                $caso->linea_intervencion_id = $casoData['linea_intervencion']['id'];
            }
            if (isset($casoData['origen'])) {
                $caso->origen_id = $casoData['origen']['id'];
            }
            if (isset($casoData['turno'])) {
                $caso->turno_id = $casoData['turno']['id'];
            }
            if (isset($casoData['etnicidad'])) {
                $caso->etnicidad_id = $casoData['etnicidad']['id'];
            }
            if (isset($casoData['relacion'])) {
                $caso->relacion_id = $casoData['relacion']['id'];
            }
            if (isset($casoData['remision'])) {
                $caso->remision_id = $casoData['remision']['id'];
            }
            if (isset($casoData['respuesta'])) {
                $caso->respuesta_id = $casoData['respuesta']['id'];
            }
            if (isset($casoData['radicado'])) {
                $caso->radicado_id = $casoData['radicado']['id'];
            }
            $caso->save();
            return $caso;
        } catch (\Throwable $th) {
            throw $th;
        }
        return null;
    }

    public function storeOrUpdatePaciente($caso, $pacienteData, &$tipoPaciente)
    {
        try {
            $paciente = null;
            if (isset($pacienteData['id'])) {
                $paciente = Paciente::find($pacienteData['id']);
                $tipoPaciente = TipoPaciente::ID_EXISTENTE;
            }
            if (!$paciente) {
                $paciente = new Paciente();
                $tipoPaciente = TipoPaciente::ID_NUEVO;
            }

            $paciente->nombre = $pacienteData['nombre'];
            $paciente->apellido = $pacienteData['apellido'];
            $paciente->sisben = $pacienteData['sisben'];
            $paciente->identificacion = $pacienteData['identificacion'];
            $paciente->edad = $pacienteData['edad'];
            $paciente->direccion = $pacienteData['direccion'];
            $paciente->fecha_nacimiento = $pacienteData['fecha_nacimiento'];
            $paciente->como_conocio_descripcion = $pacienteData['como_conocio_descripcion'];

            if (isset($pacienteData['orientacion_sexual'])) {
                $paciente->orientacion_sexual_id = $pacienteData['orientacion_sexual']['id'];
            }

            if (isset($pacienteData['genero'])) {
                $paciente->genero_id = $pacienteData['genero']['id'];
            }

            if (isset($pacienteData['sexo'])) {
                $paciente->sexo_id = $pacienteData['sexo']['id'];
            }

            if (isset($pacienteData['etnia'])) {
                $paciente->etnia_id = $pacienteData['etnia']['id'];
            }

            if (isset($pacienteData['estado_civil'])) {
                $paciente->estado_civil_id = $pacienteData['estado_civil']['id'];
            }

            if (isset($pacienteData['ocupacion'])) {
                $paciente->ocupacion_id = $pacienteData['ocupacion']['id'];
            }

            if (isset($pacienteData['nivel_educacion'])) {
                $paciente->nivel_educacion_id = $pacienteData['nivel_educacion']['id'];
            }

            if (isset($pacienteData['zona'])) {
                $paciente->zona_id = $pacienteData['zona']['id'];
            }

            if (isset($pacienteData['tipo_identificacion'])) {
                $paciente->tipo_identificacion_id = $pacienteData['tipo_identificacion']['id'];
            }

            if (isset($pacienteData['poblacion_interes'])) {
                $paciente->poblacion_interes_id = $pacienteData['poblacion_interes']['id'];
            }

            if (isset($pacienteData['municipio'])) {
                $paciente->municipio_id = $pacienteData['municipio']['id'];
            }

            if (isset($pacienteData['departamento'])) {
                $paciente->departamento_id = $pacienteData['departamento']['id'];
            }

            if (isset($pacienteData['vereda'])) {
                $paciente->vereda_id = $pacienteData['vereda']['id'];
            }

            if (isset($pacienteData['como_conocio'])) {
                $paciente->como_conocio_id = $pacienteData['como_conocio']['id'];
            }

            $paciente->save();

            return $paciente;
        } catch (\Throwable $th) {
            throw $th;
        }
        return null;
    }

    public function casoById($id)
    {
        $caso = Caso::with([
            'paciente' => function ($qPaciente) {
                return $qPaciente->with(
                    'orientacion_sexual',
                    'genero',
                    'sexo',
                    'etnia',
                    'estado_civil',
                    'ocupacion',
                    'nivel_educacion',
                    'zona',
                    'tipo_identificacion',
                    'poblacion_interes',
                    'municipio',
                    'departamento',
                    'vereda',
                    'como_conocio'
                );
            },
            'usuario',
            'origen',
            'motivo_consulta',
            'motivo_consulta_especifico',
            'linea_intervencion',
            'quien_comunica',
            'tipo_paciente',
            'turno',
            'etnicidad',
            'relacion',
            'remision',
            'respuesta',
            'radicado',
        ])->findOrFail($id);

        return response()->json($caso);
    }
}
