<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComoConocio extends Model
{
    use HasFactory;
    protected $table = 'como_conocieron';
    public $timestamps = false;
}
