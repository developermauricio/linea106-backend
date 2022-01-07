<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use Illuminate\Http\Request;

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
            'linea_intervencion'
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

        return response()->json($casos->paginate(10));
    }

    public function show($id)
    {
        $caso = Caso::with([
            'paciente',
            'motivo_consulta',
            'quien_comunica',
            'linea_intervencion',
            'usuario',
            'tipo_paciente',
            'origen',
            'motivo',
            'turno',
            'tipo_caso',
            'tipo_caso_especifico',
            'etnicidad',
            'relacion',
            'remision',
            'respuesta',
            'radicado',
        ])->find($id);
        return response()->json($caso);
    }
}
