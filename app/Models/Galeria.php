<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'evento_id',
        'imagen_id',
        'orden',
    ];

    public function imagen()
    {
        return $this->belongsTo(Imagen::class,'imagen_id');
    }
}
