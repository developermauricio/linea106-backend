<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuienComunica extends Model
{
    use HasFactory;
    protected $table = 'quienes_comunican';
    public $timestamps = false;
}
