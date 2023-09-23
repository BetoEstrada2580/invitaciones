<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    
    protected $casts = [ 'fecha'=>'datetime'];

    protected $fillable = [
        'tipo_evento_id',
        'nivel_paquete_id',
        'plantilla_id',
        'user_id',
        'clave',
        'festejado',
        'titulo',
        'fecha',
        'mensaje',
        'titulo_final',
        'mensaje_final',
        'hashtag',
        'video',
        'cancion',
        'created_by',
        'updated_by',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
