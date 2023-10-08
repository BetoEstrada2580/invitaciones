<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'mesa_id',
        'estatus_invitacion_id',
        'codigo',
        'nombre',
        'email',
        'telefono',
        'pases',
    ];

    public function estatus()
    {
        return $this->belongsTo(Estatus_invitacion::class,'estatus_invitacion_id');
    }
}
