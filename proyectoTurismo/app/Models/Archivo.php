<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $table = "archivos";
    protected $fillable = [
        'nombre',
        'url',
        'fecha_subida'
    ];
    public $timestamps = false;

    //Relacion uno a muchos con Registros
    public function registros(){
        return $this->hasMany(DetallesHoteles::class);
    }
}
