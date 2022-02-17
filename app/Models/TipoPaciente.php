<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPaciente extends Model
{
    const ID_EXISTENTE = 2;
    const ID_NUEVO = 1;

    use HasFactory;
    public $timestamps = false;
}
