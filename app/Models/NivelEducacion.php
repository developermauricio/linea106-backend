<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEducacion extends Model
{
    use HasFactory;
    protected $table = 'niveles_educacion';
    public $timestamps = false;
}
