<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function origen()
    {
        return $this->belongsTo(Origen::class, 'origen_id');
    }

    public function motivo_consulta()
    {
        return $this->belongsTo(MotivoConsulta::class, 'motivo_consulta_id');
    }

    public function linea_intervencion()
    {
        return $this->belongsTo(LineaIntervencion::class, 'linea_intervencion_id');
    }

    public function quien_comunica()
    {
        return $this->belongsTo(QuienComunica::class, 'quien_comunica_id');
    }

    public function tipo_paciente()
    {
        return $this->belongsTo(TipoPaciente::class, 'tipo_paciente_id');
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class, 'motivo_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    public function tipo_caso()
    {
        return $this->belongsTo(TipoCaso::class, 'tipo_caso_id');
    }

    public function tipo_caso_especifico()
    {
        return $this->belongsTo(TipoCasoEspecifico::class, 'tipo_caso_especifico_id');
    }

    public function etnicidad()
    {
        return $this->belongsTo(Etnicidad::class, 'etnicidad_id');
    }

    public function relacion()
    {
        return $this->belongsTo(Relacion::class, 'relacion_id');
    }

    public function remision()
    {
        return $this->belongsTo(Remision::class, 'remision_id');
    }

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'respuesta_id');
    }

    public function radicado()
    {
        return $this->belongsTo(Radicado::class, 'radicado_id');
    }
}
