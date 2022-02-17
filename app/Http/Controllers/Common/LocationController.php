<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Vereda;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function getMunicipiosByDepartamento($idDepartamento, Request $request)
    {
        $query = $request->input('query');
        $municipios = Municipio::where('departamento_id', $idDepartamento);
        if ($query) {
            $municipios->where('name', 'like', "%{$query}%");
        }
        $municipios = $municipios->get();
        return response()->json($municipios);
    }

    public function getVeredasByMunicipio($idMunicipio, Request $request)
    {
        $query = $request->input('query');
        $veredas = Vereda::where('municipio_id', $idMunicipio);
        if ($query) {
            $veredas->where('name', 'like', "%{$query}%");
        }
        $veredas = $veredas->get();
        return response()->json($veredas);
    }
}
