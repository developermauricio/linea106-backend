<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Caso;
use App\Models\User;
use Illuminate\Http\Request;

class StaticsController extends Controller
{
    private $isPsicologo = false;

    public function __construct()
    {
        $this->isPsicologo = auth('api')->user()->rol === User::PSICOLOGO;
    }

    public function getStatics(Request $request)
    {
        $fechaInicio = \Carbon\Carbon::parse($request->input('fecha_inicio'));
        $fechaFin = \Carbon\Carbon::parse($request->input('fecha_fin'));

        $totalCasos = 0;

        $casos_psicologo = $this->statisticByPsicologo($fechaInicio, $fechaFin, $totalCasos);
        $casos_origen = $this->statisticByOrigen($fechaInicio, $fechaFin);
        $casos_municipios = $this->statisticByMunicipios($fechaInicio, $fechaFin);
        $casos_edades = $this->statisticByEdades($fechaInicio, $fechaFin);
        $casos_sexo = $this->statisticBySexo($fechaInicio, $fechaFin);
        $casos_genero = $this->statisticByGenero($fechaInicio, $fechaFin);
        $casos_zona = $this->statisticByZona($fechaInicio, $fechaFin);
        $casos_motivo_consulta = $this->statisticByMotivoConsulta($fechaInicio, $fechaFin);
        $casos_linea_intervencion = $this->statisticByLineaIntervencion($fechaInicio, $fechaFin);

        return response()->json([
            'total' => $totalCasos,
            'casos_by_origen' => $casos_origen,
            'casos_psicologo' => $casos_psicologo,
            'casos_municipios' => $casos_municipios,
            'casos_edades' => $casos_edades,
            'casos_sexo' => $casos_sexo,
            'casos_genero' => $casos_genero,
            'casos_zona' => $casos_zona,
            'casos_motivo_consulta' => $casos_motivo_consulta,
            'casos_linea_intervencion' => $casos_linea_intervencion,
        ]);
    }

    private function statisticByLineaIntervencion($fechaInicio, $fechaFin)
    {
        $casos_zona = Caso::selectRaw('lineas_intervencion.name as nombre, count(linea_intervencion_id) as total')
            ->join('lineas_intervencion', 'casos.linea_intervencion_id', '=', 'lineas_intervencion.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('linea_intervencion_id')
            ->whereNotNull('linea_intervencion_id')
            ->get();

        $casos_zona_anonimos = Caso::query()
            ->leftJoin('lineas_intervencion', 'casos.linea_intervencion_id', '=', 'lineas_intervencion.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('linea_intervencion_id')
            ->count();

        if ($casos_zona_anonimos > 0) {
            $casos_zona->add(
                $this->getAnonimo($casos_zona_anonimos)
            );
        }

        return $casos_zona;
    }

    private function statisticByMotivoConsulta($fechaInicio, $fechaFin)
    {
        $casos_motivo = Caso::selectRaw('motivo_consultas.name as nombre, count(motivo_consulta_id) as total')
            ->join('motivo_consultas', 'casos.motivo_consulta_id', '=', 'motivo_consultas.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('motivo_consulta_id')
            ->whereNotNull('motivo_consulta_id')
            ->get();

        $casos_motivo_anonimos = Caso::query()
            ->leftJoin('motivo_consultas', 'casos.motivo_consulta_id', '=', 'motivo_consultas.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('motivo_consulta_id')
            ->count();

        if ($casos_motivo_anonimos > 0) {
            $casos_motivo->add(
                $this->getAnonimo($casos_motivo_anonimos)
            );
        }

        return $casos_motivo;
    }

    private function statisticByZona($fechaInicio, $fechaFin)
    {
        $casos_zona = Caso::selectRaw('zonas.name as nombre, count(zona_id) as total')
            ->join('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->join('zonas', 'pacientes.zona_id', '=', 'zonas.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('zona_id')
            ->whereNotNull('zona_id')
            ->get();

        $casos_zona_anonimos = Caso::query()
            ->leftJoin('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('zona_id')
            ->count();

        if ($casos_zona_anonimos > 0) {
            $casos_zona->add(
                $this->getAnonimo($casos_zona_anonimos)
            );
        }

        return $casos_zona;
    }

    private function statisticByGenero($fechaInicio, $fechaFin)
    {
        $casos_genero = Caso::selectRaw('generos.name as nombre, count(genero_id) as total')
            ->join('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->join('generos', 'pacientes.genero_id', '=', 'generos.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('genero_id')
            ->whereNotNull('genero_id')
            ->get();

        $casos_genero_anonimos = Caso::query()
            ->leftJoin('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('genero_id')
            ->count();

        if ($casos_genero_anonimos > 0) {
            $casos_genero->add(
                $this->getAnonimo($casos_genero_anonimos)
            );
        }

        return $casos_genero;
    }

    private function statisticBySexo($fechaInicio, $fechaFin)
    {
        $casos_sexo = Caso::selectRaw('sexos.name as nombre, count(sexo_id) as total')
            ->join('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->join('sexos', 'pacientes.sexo_id', '=', 'sexos.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('sexo_id')
            ->whereNotNull('sexo_id')
            ->get();

        $casos_sexo_anonimos = Caso::query()
            ->leftJoin('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('sexo_id')
            ->count();
        if ($casos_sexo_anonimos > 0) {
            $casos_sexo->add(
                $this->getAnonimo($casos_sexo_anonimos)
            );
        }
        return $casos_sexo;
    }

    private function statisticByEdades($fechaInicio, $fechaFin)
    {
        $casos_edades = Caso::selectRaw('pacientes.edad, count(edad) as total')
            ->join('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('edad')
            ->whereNotNull('edad')
            ->get();

        $casos_edades_nulas = Caso::query()
            ->leftJoin('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('edad')
            ->count();

        $anonimo = $casos_edades_nulas;
        $entre1_10 = 0;
        $entre11_20 = 0;
        $entre21_30 = 0;
        $entre31_40 = 0;
        $entre41_50 = 0;
        $mas50 = 0;

        foreach ($casos_edades as $caso_edad) {
            if (!$caso_edad->edad) {
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
            ['nombre' => 'Anónimo', 'total' => $anonimo],
            ['nombre' => 'Entre 1 y 10 años', 'total' => $entre1_10],
            ['nombre' => 'Entre 11 y 20 años', 'total' => $entre11_20],
            ['nombre' => 'Entre 21 y 30 años', 'total' => $entre21_30],
            ['nombre' => 'Entre 31 y 40 años', 'total' => $entre31_40],
            ['nombre' => 'Entre 41 y 50 años', 'total' => $entre41_50],
            ['nombre' => 'Más de 50 años', 'total' => $mas50]
        ];
    }

    private function statisticByMunicipios($fechaInicio, $fechaFin)
    {
        $casos_municipios = Caso::selectRaw('municipios.name as nombre, count(municipio_id) as total')
            ->join('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->join('municipios', 'pacientes.municipio_id', '=', 'municipios.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNotNull('pacientes.municipio_id')
            ->groupBy('municipio_id')
            ->get();

        $casos_anonimos = Caso::selectRaw('casos.id')
            ->leftJoin('pacientes', 'casos.paciente_id', '=', 'pacientes.id')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->whereNull('pacientes.municipio_id')
            ->count();

        if ($casos_anonimos > 0) {
            $casos_municipios->push(
                $this->getAnonimo($casos_anonimos)
            );
        }
        return $casos_municipios;
    }


    private function statisticByOrigen($fechaInicio, $fechaFin)
    {
        $casos_origen = Caso::selectRaw('origen_id, count(origen_id) as total')->with('origen:id,name')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('origen_id')
            ->get();

        return $casos_origen->map(function ($caso) {
            $statistic = new \stdClass();
            $statistic->nombre = $caso->origen->name;
            $statistic->total = $caso->total;
            return $statistic;
        });
    }


    private function statisticByPsicologo($fechaInicio, $fechaFin, &$totalCasos)
    {
        $casos_psicologo = Caso::selectRaw('usuario_id, count(usuario_id) as total')->with('usuario:id,name,last_name')
            ->byAuthUser($this->isPsicologo)
            ->filterByDate($fechaInicio, $fechaFin)
            ->groupBy('usuario_id')
            ->get();
        return $casos_psicologo->map(function ($caso) use (&$totalCasos) {
            $statistic = new \stdClass();
            $statistic->nombre = $this->getNamePsicologo($caso->usuario);
            $statistic->total = $caso->total;
            $totalCasos += $caso->total;
            return $statistic;
        });
    }

    private function getNamePsicologo($usuario)
    {
        return trim(
            $this->getString($usuario->name) . ' ' . $this->getString($usuario->last_name)
        );
    }

    private function getString($string)
    {
        if ($string) {
            return trim($string);
        }
        return '';
    }

    private function getAnonimo($total)
    {
        $anonimo = new \stdClass();
        $anonimo->nombre = 'Anónimo';
        $anonimo->total = $total;
        return $anonimo;
    }
}
