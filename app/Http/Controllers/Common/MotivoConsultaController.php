<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\MotivoConsulta;
use Illuminate\Http\Request;

class MotivoConsultaController extends Controller
{
    public function getMotivosConsultaReportes()
    {
        $motivosConsulta = MotivoConsulta::query()
            ->where('name', '<>', 'no aplica')
            ->where('name', '<>', 'otro')
            ->where('name', '<>', 'juego')
            ->where('name', '<>', 'protocolos internos')
            ->get();
        return response()->json($motivosConsulta);
    }
}
