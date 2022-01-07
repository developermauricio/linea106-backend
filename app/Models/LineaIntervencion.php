<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaIntervencion extends Model
{
    use HasFactory;
    protected $table = 'lineas_intervencion';
    public $timestamps = false;
}
