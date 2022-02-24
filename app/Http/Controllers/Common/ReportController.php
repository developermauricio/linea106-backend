<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use App\Models\MotivoConsulta;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReporteCasos(Request $request)
    {
        $year = $request->input('y');

        $casos = Caso::query()
            ->selectRaw('DATE_FORMAT(fecha_inicio, "%m") as label, count(id) as total')
            ->groupByRaw('label')->orderBy('label', 'asc')
            ->byYear($year)->get();

        return response()->json($casos);
    }

    public function getSuicidioReporte(Request $request)
    {
        $year = $request->input('y', 2021);

        $idMotivoConsulta = MotivoConsulta::select('id')->where('name', 'Suicidio')->first()->id;

        $casos = Caso::query()
            ->with('motivo_consulta_especifico:id,name')
            ->selectRaw('DATE_FORMAT(fecha_inicio, "%m") as label,motivo_consulta_especifico_id,  count(id) as total')
            ->where('motivo_consulta_id', $idMotivoConsulta)
            ->groupByRaw('motivo_consulta_especifico_id, label')
            ->orderBy('label', 'asc')
            ->orderBy('motivo_consulta_especifico_id', 'asc')
            ->byYear($year)
            ->get();

        return response()->json($casos);
    }

    public function getMenoresReporte(Request $request)
    {
        $year = $request->input('y');

        $minEdad = 4;
        $maxEdad = 13;
        $casos = Caso::query()
            ->selectRaw('DATE_FORMAT(fecha_inicio, "%m") as label, count(casos.id) as total')
            ->join('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->groupByRaw('label')
            ->orderBy('label', 'asc')
            ->whereBetween('pacientes.edad', [$minEdad, $maxEdad])
            ->byYear($year)->get();

        return response()->json($casos);
    }

    /*
    $casos = Caso::query()
            ->select('fecha_inicio')
            ->byMonth($date)
            ->get();
    */

    public function getMesPsicologos(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('concat(users.name, " ",users.last_name) as nombre, count(casos.id) as total')
            ->join('users', 'users.id', 'usuario_id')
            ->groupBy('users.id')
            ->byMonth($date)
            ->get();

        return response()->json($casos);
    }

    public function getMesOrigenes(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('origenes.name, count(casos.id) as total')
            ->leftJoin('origenes', 'origenes.id', '=', 'origen_id')
            ->byMonth($date)
            ->groupBy('origen_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesTipoPacientes(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('tipo_pacientes.name, count(casos.id) as total')
            ->leftJoin('tipo_pacientes', 'tipo_pacientes.id', '=', 'tipo_paciente_id')
            ->byMonth($date)
            ->groupBy('tipo_paciente_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesTurnos(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('turnos.name, count(casos.id) as total')
            ->leftJoin('turnos', 'turnos.id', '=', 'turno_id')
            ->byMonth($date)
            ->groupBy('turno_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesEdades(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('edad, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'paciente_id')
            ->byMonth($date)
            ->groupBy('edad')
            ->get();

        $anonimo = 0;
        $entre1_10 = 0;
        $entre11_20 = 0;
        $entre21_30 = 0;
        $entre31_40 = 0;
        $entre41_50 = 0;
        $mas50 = 0;

        foreach ($casos as $caso_edad) {
            if ($caso_edad->edad == null) {
                $anonimo += $caso_edad->total;
            } else if ($caso_edad->edad <= 10) {
                $entre1_10 += $caso_edad->total;
            } else if ($caso_edad->edad <= 20) {
                $entre11_20 += $caso_edad->total;
            } else if ($caso_edad->edad <= 30) {
                $entre21_30 += $caso_edad->total;
            } else if ($caso_edad->edad <= 40) {
                $entre31_40 += $caso_edad->total;
            } else if ($caso_edad->edad <= 50) {
                $entre41_50 += $caso_edad->total;
            } else {
                $mas50 += $caso_edad->total;
            }
        }

        return [
            ['name' => 'Anónimo', 'total' => $anonimo],
            ['name' => 'Entre 1 y 10 años', 'total' => $entre1_10],
            ['name' => 'Entre 11 y 20 años', 'total' => $entre11_20],
            ['name' => 'Entre 21 y 30 años', 'total' => $entre21_30],
            ['name' => 'Entre 31 y 40 años', 'total' => $entre31_40],
            ['name' => 'Entre 41 y 50 años', 'total' => $entre41_50],
            ['name' => 'Más de 50 años', 'total' => $mas50]
        ];
    }


    public function getMesEscolaridades(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('niveles_educacion.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('niveles_educacion', 'niveles_educacion.id', '=', 'pacientes.nivel_educacion_id')
            ->byMonth($date)
            ->groupBy('nivel_educacion_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesSexos(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('sexos.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('sexos', 'sexos.id', '=', 'pacientes.sexo_id')
            ->byMonth($date)
            ->groupBy('sexo_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesZonas(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('zonas.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('zonas', 'zonas.id', '=', 'pacientes.zona_id')
            ->byMonth($date)
            ->groupBy('zona_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesOcupaciones(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('ocupaciones.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('ocupaciones', 'ocupaciones.id', '=', 'pacientes.ocupacion_id')
            ->byMonth($date)
            ->groupBy('ocupacion_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesGeneros(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('generos.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('generos', 'generos.id', '=', 'pacientes.genero_id')
            ->byMonth($date)
            ->groupBy('genero_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesCiudades(Request $request)
    {
        $date = $request->input('d');

        $casos = Caso::query()
            ->selectRaw('municipios.name, count(casos.id) as total')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'casos.paciente_id')
            ->leftJoin('municipios', 'municipios.id', '=', 'pacientes.municipio_id')
            ->byMonth($date)
            ->groupBy('municipio_id')
            ->get();

        return response()->json($casos);
    }

    public function getMesMotivosEspecificos(Request $request)
    {
        $date = $request->input('d');
        $motivo_id = $request->input('motivo');

        $casos = Caso::query()
            ->selectRaw('motivo_consulta_especificos.name, count(casos.id) as total')
            ->join('motivo_consulta_especificos', 'motivo_consulta_especificos.id', '=', 'casos.motivo_consulta_especifico_id')
            ->byMonth($date)
            ->where('casos.motivo_consulta_id', $motivo_id)
            ->groupBy('motivo_consulta_especifico_id')
            ->get();

        return response()->json($casos);
    }
}
