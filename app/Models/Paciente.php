<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    public function orientacion_sexual()
    {
        return $this->belongsTo(OrientacionSexual::class, 'orientacion_sexual_id');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexo_id');
    }

    public function etnia()
    {
        return $this->belongsTo(Etnia::class, 'etnia_id');
    }

    public function estado_civil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }

    public function ocupacion()
    {
        return $this->belongsTo(Ocupacion::class, 'ocupacion_id');
    }

    public function nivel_educacion()
    {
        return $this->belongsTo(NivelEducacion::class, 'nivel_educacion_id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function tipo_identificacion()
    {
        return $this->belongsTo(TipoIdentificacion::class, 'tipo_identificacion_id');
    }

    public function poblacion_interes()
    {
        return $this->belongsTo(PoblacionInteres::class, 'poblacion_interes_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function vereda()
    {
        return $this->belongsTo(Vereda::class, 'vereda_id');
    }

    public function como_conocio()
    {
        return $this->belongsTo(ComoConocio::class, 'como_conocio_id');
    }
}
