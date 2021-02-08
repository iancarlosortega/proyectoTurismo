<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graficas extends Model
{
    use HasFactory;
    protected $table = "graficas";
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'ruta'
    ];
    public $timestamps = false;

    //Relacion uno a muchos con Registros
}
