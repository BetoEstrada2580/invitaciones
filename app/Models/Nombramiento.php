<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombramiento extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'invitacion_id',
        'titulo',
        'imagen_id',
        'orden',
    ];

    public function invitado()
    {
        return $this->belongsTo(Invitacion::class,'invitacion_id');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class,'imagen_id');
    }
}
