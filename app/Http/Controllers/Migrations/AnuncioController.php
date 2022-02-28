<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class AnuncioController extends Controller
{

    const ATTRIBUTES = ',key_server,id,fecha,contenido,titulo,';

    private $attributes = ["key_server","id","fecha","contenido","titulo"];

    public function restore(Request $request)
    {
        $anuncios = collect($request->input('items'));

        $errores = [];
        $anuncios->each(function ($anuncio) use (&$errores) {
            $error = $this->createAnuncio($anuncio);
            if ($error) {
                $errorData = new \stdClass();
                $errorData->msg = $error;
                $errorData->data = $anuncio;
                $errores[] = $errorData;
            }
        });
        if (isset($errores[0])) {
            return response()->json($errores, 500);
        }
        return response()->json([], 201);
    }

    private function getKey($data)
    {
        if (isset($data["key_server"]) && $data["key_server"] && trim($data["key_server"])) {
            return $data["key_server"];
        }
        $key = '';
        foreach ($this->attributes as $attribute) {
            if (isset($data[$attribute]) && $data[$attribute]) {
                $key .= '_' . $data[$attribute];
            } else {
                $key .= '_';
            }
        }
        return $key;
    }

    private function createAnuncio($data)
    {
        try {
            $key = md5($this->getKey($data));
            $anuncio = Anuncio::where('key', $key)->first();
            if (!$anuncio) {
                DB::beginTransaction();
                $anuncio = new Anuncio();
                $anuncio->key_server = $data['key_server'];
                $anuncio->key = $key;

                foreach ($data as $key => $value) {
                    if (!strpos(self::ATTRIBUTES, $key)) {
                        throw new \Exception('Nuevo atributo: ' . $key, 1);
                    }
                    switch ($key) {
                        case 'fecha':
                            $anuncio->created_at = $value;
                            break;
                        case 'contenido':
                            $anuncio->description = $value;
                            break;
                        case 'titulo':
                            $anuncio->title = $value;
                            break;
                    }
                }
                $anuncio->save();
                DB::commit();
            }
            return null;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
}
