<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::orderBy('id', 'DESC')->get();
        return response()->json($anuncios);
    }

    public function store(Request $request)
    {
        $anuncio = new Anuncio();
        $anuncio->title = trim($request->input('title'));
        $anuncio->description = trim($request->input('description'));
        $anuncio->save();

        return response()->json($anuncio, 201);
    }

    public function update($id, Request $request)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->title = trim($request->input('title'));
        $anuncio->description = trim($request->input('description'));
        $anuncio->save();

        return response()->json($anuncio, 200);
    }

    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->delete();

        return response()->json([], 204);
    }

    public function show($id)
    {
        $anuncio = Anuncio::find($id);

        return response()->json($anuncio);
    }
}
