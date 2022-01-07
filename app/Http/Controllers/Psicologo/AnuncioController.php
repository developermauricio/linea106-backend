<?php

namespace App\Http\Controllers\Psicologo;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{

    public function getAll()
    {
        $anuncios = Anuncio::select('id', 'title', 'description', 'created_at')->get();
        return response()->json($anuncios);
    }
}
