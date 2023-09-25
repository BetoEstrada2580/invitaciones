<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'tipo_imagen_id',
        'url',
    ];
    
}
