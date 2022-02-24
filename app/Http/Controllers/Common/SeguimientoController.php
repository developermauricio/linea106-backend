<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{

    public function getSeguimientosByCase($idCase)
    {
        $seguimientos = [];
        if (is_numeric($idCase)) {
            $seguimientos = Seguimiento::query()
                ->select('id', 'seguimiento', 'created_at')
                ->where('caso_id', $idCase)
                ->orderBy('id', 'DESC')->get();
        }
        return response()->json($seguimientos);
    }

    public function storeSeguimiento(Request $request)
    {
        $seguimiento = new Seguimiento();
        $seguimiento->seguimiento = $request->input('seguimiento');
        $seguimiento->caso_id = $request->input('caso_id');
        $seguimiento->usuario_id = auth('api')->user()->id;
        $seguimiento->save();

        return response()->json($seguimiento, 201);
    }
}
