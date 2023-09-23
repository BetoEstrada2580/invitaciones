<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $casts = [ 'fecha'=>'datetime'];

    protected $fillable = [
        'evento_id',
        'tipo_ubicacion_id',
        'nombre',
        'fecha',
        'direccion',
        'url',
    ];
}
