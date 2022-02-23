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
}
