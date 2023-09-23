<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa_regalo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'tipo_mesa_regalo_id',
        'codigo',
        'url',
        'banco',
        'clabe',
    ];

    public function tipoMesa()
    {
        return $this->belongsTo(Tipo_mesa_regalo::class,'tipo_mesa_regalo_id');
    }
}
