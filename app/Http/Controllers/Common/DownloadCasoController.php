<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class DownloadCasoController extends Controller
{
    public function downloadExcel(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        if (!$fechaFin || !$fechaInicio) {
            return response()->json(['msg' => 'Parámetros inválidos'], 405);
        }

        $casos = Caso::query()
            ->selectRaw('
            casos.id as "Caso",
            TRIM(concat(coalesce(users.name,"")," ", coalesce(users.last_name,""))) as Psicólogo,
            fecha_inicio as "Fecha Inicio",
            fecha_fin as "Fecha Fin",
            casos.updated_at as "Última Actualización",
            quienes_comunican.name as "Quien Comunica",
            documento_llama as "Documento Llama",
            nombre_llama as "Nombre Llama",
            relaciones.name as Relación,
            fuente as Fuente,
            origenes.name as Origen,
            motivo_consultas.name as "Motivo Consulta",
            motivo_consulta_especificos.name as "Motivo Consulta Especifico",
            descripcion_motivo as "Descripción Motivo",
            narrativa as Narrativa,
            observaciones as Observaciones,
            como_conocio_descripcion as "Como Conoció",
            lineas_intervencion.name as "Linea Intervención",
            remisiones.name as Remisión,
            respuestas.name as Respuesta,
            descripcion_radicado as Radicado,
            turnos.name as Turno,
            tipo_pacientes.name as "Tipo Paciente",
            pacientes.id as "Paciente",
            TRIM(concat(coalesce(pacientes.nombre,""), " ",coalesce(pacientes.apellido, "" ))) as "Nombre Paciente",
            tipos_identificacion.name as "Tipo Identificación",
            pacientes.identificacion as Identificación,
            sexos.name as Sexo,
            generos.name as Genero,
            pacientes.edad as Edad,
            pacientes.fecha_nacimiento as "Fecha Nacimiento",
            pacientes.direccion as Dirección,
            pacientes.sisben as "Sisben",
            zonas.name as Zona,
            departamentos.name as Departamento,
            municipios.name as Municipio,
            veredas.name as Vereda,
            estados_civiles.name as "Estado Civil",
            niveles_educacion.name as "Escolaridad",
            ocupaciones.name as "Ocupación",
            poblaciones_interes.name as "Población Interés",
            orientaciones_sexuales.name as "Orientación Sexual",
            etnias.name as "Etnia"
            ')
            ->whereDate('fecha_inicio', '>=', $fechaInicio)
            ->whereDate('fecha_inicio', '<=', $fechaFin)
            ->leftJoin('users', 'usuario_id', 'users.id')
            ->leftJoin('quienes_comunican', 'quien_comunica_id', 'quienes_comunican.id')
            ->leftJoin('relaciones', 'relacion_id', 'relaciones.id')
            ->leftJoin('origenes', 'origen_id', 'origenes.id')
            ->leftJoin('respuestas', 'respuesta_id', 'respuestas.id')
            ->leftJoin('lineas_intervencion', 'linea_intervencion_id', 'lineas_intervencion.id')
            ->leftJoin('remisiones', 'remision_id', 'remisiones.id')
            ->leftJoin('turnos', 'turno_id', 'turnos.id')
            ->leftJoin('motivo_consultas', 'motivo_consulta_id', 'motivo_consultas.id')
            ->leftJoin('motivo_consulta_especificos', 'motivo_consulta_especifico_id', 'motivo_consulta_especificos.id')
            ->leftJoin('tipo_pacientes', 'tipo_paciente_id', 'tipo_pacientes.id')
            ->leftJoin('pacientes', 'paciente_id', 'pacientes.id')
            ->leftJoin('sexos', 'sexo_id', 'sexos.id')
            ->leftJoin('generos', 'genero_id', 'generos.id')
            ->leftJoin('zonas', 'zona_id', 'zonas.id')
            ->leftJoin('estados_civiles', 'estado_civil_id', 'estados_civiles.id')
            ->leftJoin('niveles_educacion', 'nivel_educacion_id', 'niveles_educacion.id')
            ->leftJoin('etnias', 'etnia_id', 'etnias.id')
            ->leftJoin('orientaciones_sexuales', 'orientacion_sexual_id', 'orientaciones_sexuales.id')
            ->leftJoin('poblaciones_interes', 'poblacion_interes_id', 'poblaciones_interes.id')
            ->leftJoin('ocupaciones', 'ocupacion_id', 'ocupaciones.id')
            ->leftJoin('tipos_identificacion', 'tipo_identificacion_id', 'tipos_identificacion.id')
            ->leftJoin('departamentos', 'departamento_id', 'departamentos.id')
            ->leftJoin('municipios', 'municipio_id', 'municipios.id')
            ->leftJoin('veredas', 'vereda_id', 'veredas.id')
            ->orderBy('fecha_inicio', 'ASC')
            ->get();

        $fileName = "casos_{$fechaInicio}_to_{$fechaFin}.xlsx";
        return (new FastExcel($casos))->download($fileName);
    }
}
